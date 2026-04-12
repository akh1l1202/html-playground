$(document).ready(function() {
    let timeout = null;

    $('#searchInput').on('keyup', function() {
        let query = $(this).val().trim();
        clearTimeout(timeout);

        if (query.length > 1) {
            $('#searchLoader').show(); 

            timeout = setTimeout(function() {
                $.ajax({
                    url: 'search.php',
                    type: 'GET',
                    data: { query: query },
                    dataType: 'json',
                    success: function(data) {
                        $('#resultsGrid').empty();
                        $('#searchLoader').hide();

                        if (data.length > 0) {
                            $.each(data, function(i, item) {
                                $('#resultsGrid').append(`
                                    <div class="product-card">
                                        <h3>${item.name}</h3>
                                        <p>${item.description}</p>
                                        <div class="price">$${item.price}</div>
                                    </div>
                                `);
                            });
                        } else {
                            $('#resultsGrid').html('<p class="no-results">No products found matching your search.</p>');
                        }
                    }
                });
            }, 400); // 400ms debounce
        } else {
            $('#resultsGrid').html('<div class="placeholder-text">Type something to explore our catalog...</div>');
            $('#searchLoader').hide();
        }
    });
});