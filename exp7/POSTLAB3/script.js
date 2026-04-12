$(document).ready(function() {
    let offset = 0; 
    const limit = 3; 

    // Function to fetch posts
    function fetchPosts() {
        const btn = $('#loadMoreBtn');
        btn.text('Loading...').prop('disabled', true);

        $.ajax({
            url: 'load_posts.php',
            type: 'GET',
            data: { 
                offset: offset,
                limit: limit 
            },
            dataType: 'json',
            success: function(data) {
                if (data.length > 0) {
                    $.each(data, function(i, post) {
                        $('#postContainer').append(`
                            <article class="post-card">
                                <h3>${post.title}</h3>
                                <p>${post.content}</p>
                                <small>Posted on: ${post.created_at}</small>
                            </article>
                        `);
                    });

                    offset += limit;
                    btn.text('Load More Posts').prop('disabled', false);
                }
                
                if (data.length < limit) {
                    btn.text('No More Posts').prop('disabled', true).fadeOut(2000);
                }
            },
            error: function() {
                alert("Error loading posts.");
                btn.text('Load More Posts').prop('disabled', false);
            }
        });
    }

    fetchPosts();

    $('#loadMoreBtn').on('click', function() {
        fetchPosts();
    });
});