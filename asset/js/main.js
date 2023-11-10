function mostrarContraseña(idPassword, idIcon){
    let inputPassword = document.getElementById(idPassword);
    let icon = document.getElementById(idIcon);
    if(inputPassword.type =="password" && icon.classList.contains("fa-eye")){
        inputPassword.type = "text";
        icon.classList.replace("fa-eye","fa-eye-slash");
    }else{
        inputPassword.type = "password";
        icon.classList.replace("fa-eye-slash","fa-eye");
    }
}

window.fbAsyncInit = function() {
    FB.init({
    appId      : '852563055938241',
    cookie     : true,
    xfbml      : true,
    version    : 'v8.0'
    });
    
    FB.AppEvents.logPageView();   
    
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
    function onLogin(){
    FB.login((response) => {
        if(response.authResponse){
            FB.api('/me', (response) => {
                console.log(response)
            })
        }
    })
    }