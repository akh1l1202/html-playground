function toggleAuth(type) {
    const isLogin = type === 'login';

    document.getElementById('login-section')
        .classList.toggle('hidden', !isLogin);
    document.getElementById('register-section')
        .classList.toggle('hidden', isLogin);

    document.getElementById('tab-login').className = isLogin
        ? "flex-1 py-3 border-b-2 border-primary text-primary font-semibold"
        : "flex-1 py-3 text-gray-500 font-semibold";

    document.getElementById('tab-register').className = !isLogin
        ? "flex-1 py-3 border-b-2 border-primary text-primary font-semibold"
        : "flex-1 py-3 text-gray-500 font-semibold";
}