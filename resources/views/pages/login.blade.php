@extends('index')
<style>

    :root{
        --primary:rgba(5,7,21,255);
        --border: #222430;
        --block: rgb(17, 18, 32);
    }
    #blockpage{
        width: 100%;
        max-width: 100%;
        height: 100%;
        max-height: 100%;
        overflow: hidden;
        background-color: rgb(3, 5, 19);
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        padding: 0 5% 0 5%;
    }

    #blockpage .container-left, #blockpage .container-right{
        width:20%;
        height: 145%;
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
        position: relative;
        top:-20%;
    }

    #blockpage .container-right{
        position: relative;
        right:-5%;
    }
    #blockpage .container-left{
        position: relative;
        left:-5%;
    }

    #blockpage .container-left .block, #blockpage .container-right .block{
        width: 100%;
        height:25vh;
        max-height: 100%;
        border-radius: 10px;
        background-color: var(--primary);
    }

    #blockpage .container-left .block img, #blockpage .container-right .block img{
        width: 100%;
        filter: blur(15px);
        height: 100%;
        object-fit: cover;
    }

    #blockpage .container-left .block:nth-child(4) img, #blockpage .container-right .block:nth-child(4) img{}

    #blockpage .container-left .block:nth-child(4), #blockpage .container-right .block:nth-child(1){
        border: 4px solid rgba(194, 194, 194, 0.26);

    }

    .overlay{
        width: 70%;
        max-width: 70%;
        height: 100%;
        max-height: 100%;
        overflow: hidden;
        display: flex;
        padding: 5% 0 0% 0;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .overlay .logo{
        background-color:white;
        opacity:0.8;
        width:20%;
        height:10%;
        padding: 0 1% 0 0;
        border-radius: 10px;
        object-fit: cover;
    }

    .overlay .login, .overlay .register, #forgotten-pass.active{
        height:65%;
        max-height:65%;
        background-color: var(--primary);
        position: absolute;
        top:20%;
    }


    .overlay .login .login-head p, .overlay .register .register-head p{
        color:white;
    }

    .overlay .login{
        text-align:center;
        width: 100%;
        z-index: 1;
        opacity: 1;
        transform: translateY(0%);
        transition: all .5s ease;
    }
    .overlay .register{
        height:100%;
        text-align:center;
        z-index: 2;
        width: 100%;
        transform: translateY(0%);
        transition: all .5s ease;
    }

    .overlay h1{
        text-align: center;
        font-size: 2.5vh;
        font-size:2.5em;
        margin: 0 0 2% 0;
        color: white;
    }
    .overlay .login form, .register form{
        display:flex;
        border-radius: 15px;
        padding: 2.5% 10% 2.5% 10%;
        margin: 0 0 0 20%;
        flex-direction:column;
        width: 60%;
        max-width:60%;
        justify-content: center;
        overflow: hidden;
        background-color: var(--block);
    }
    .register .register-head, .login .login-head{
        width: 90%;
        margin: 2% 0 2% 5%;
    }
    .overlay form .input-container{
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 90%;
        border-radius: 10px;
        margin: 2% 0 2% 5%;
        overflow: hidden;
    }

    .overlay .register.active{
        opacity: 0;
        transform: translateY(100%);
        transition: all 0.5s ease-out;
    }
    .overlay form .btns{
        text-align: center;
    }
    .overlay form .btns div{
        font-size: 2vh;
        color: white;
    }

    .overlay form .btns button:nth-child(1){
        background-color: orange;
        color: white;
        height:5vh;

    }
    .overlay form .btns button:nth-child(3){
        background-color: #222430;
        color: white;
        border: none;
        height:5vh;
    }
    .overlay form .btns button:nth-child(1), .overlay form .btns button:nth-child(3){
        font-size: 2vh;
        border-radius: 5px;
        width: 100%;
    }
    .overlay form input::placeholder{
        color: white;
        text-align: center;
    }

    .overlay form input:focus{
        color: white;
        outline: none;
        padding: 0 5% 0 5%;
        background-color: rgba(49, 49, 49, 0.23);
    }
    .overlay form input{
        display: block;
        height:5vh;
        width: 100%;
        border: none;
        color: white;
        padding: 0 5% 0 5%;
        background-color:rgba(49, 49, 49, 0.23);
    }

    .overlay .register .btns{
        margin: 2% 0 0 0;
    }

    .overlay form button{
        font-weight: 600;
    }
    .overlay .login a{
        color: white;
        width: 100%;
        font-size:.85em;
        margin: 5% 0 5% 0;
        padding: 0 0 0 45%;
    }


    #message{
        width: 0%;
        max-height: 0vh;
        overflow:hidden;
    }
    #message .close-msg{
        font-weight:600;
        font-size:1em;
        width:30%;
        height:3vh;
        padding: 1% 0 10% 0;
        margin: 0 0 1% 0;
        border-radius:5px;
        background-color: transparent;
        border:3px solid white;
        color:white;
    }

    #message.success .success.active{
        background-color: var(--block);
        box-shadow: 0 0 20px 0 #ffffff53;
        height:20%;
        width: 20%;
        color: white;
        font-size: 1.5em;
        font-weight: 600;
        border-radius: 10px;
        display:flex;
        flex-direction: column;
        justify-content:space-evenly;
        align-items:center;
        margin: 10px 0 10px 0;
        text-align: center;
        position:fixed;
        top:0;
        left:40%;
        z-index: 100;
        transition:all .5s ease;
    }

    #message.error .success, #message.success .error{
        width: 0;
        height:0;
        max-width:0;
        max-height:0;
        overflow:hidden;
        transition: all .5s ease;
    }

    
    #message.error .error.active{
        /*  red:  #a91d1dff*/
        background-color: var(--block) ; 
        box-shadow: 0 0 10px 0 #ffffff15;
        height:20%;
        width: 20%;
        text-align:center;
        color: white;
        font-size: 1em;
        font-weight: 600;
        border-radius: 10px;
        display:flex;
        flex-direction: column;
        justify-content:space-evenly;
        align-items:center;
        margin: 10px 0 10px 0;
        position:fixed;
        top:0;
        left:40%;
        z-index: 100;
        transition:all .5s ease;
    }

    #message.error .error.active .error-msg{
        width: 100%;
        padding: 0 5% 0 5%;
        text-align:center;
    }

    #loader-overlay{
        width: 0;
        height:0;
        overflow:hidden;
        transition:all .5s ease;
    }

    #loader-overlay.active{
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 16;
        position:fixed;
        top:0;
        height:100%;
        width:100%;
        display:flex;
        justify-content: center;
        align-items:center;
    }

    #loader-overlay.active .loader{
        width: 0;
        height:0;
        overflow: hidden;
        z-index:-1;
    }

    #loader-overlay.active .loader.active{
        background-color: var(--primary);
        color:white;
        font-size: 1em;
        font-weight: 600;
        text-align:center;
        width:15%;
        height: 20%;
        z-index: 16;
        border-radius:5px;
        padding: 1% 0 2% 0;
        position:relative;

    }

    @keyframes spinner{
        0%{
            rotate :0deg
        }
        100%{
            rotate:360deg;
        }
    }
    #loader-overlay.active .spinner{
        width:50%;
        height:90%;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        margin: 2% 0 0 25%;
        animation: spinner .5s ease-out infinite;
        position:relative;
    }
    #loader-overlay.active .loader.active .spinner .top, #loader-overlay.active .loader.active .spinner .left, #loader-overlay.active .loader.active .spinner .right, #loader-overlay.active .loader.active .spinner .bottom{
        width:10px;
        height:10px;
        border-radius: 100px;
        background-color: white;
    }

    #loader-overlay.active .loader.active .spinner .top{
        position:absolute;
        top:5%;
        left: 48%;
    }

    #loader-overlay.active .loader.active .spinner .left{
        position:absolute;
        top:45%;
        left: 10%;
    }
    #loader-overlay.active .loader.active .spinner .bottom{
        position:absolute;
        bottom: 5%;
        left:48%;
    }

    #loader-overlay.active .loader.active .spinner .right{
        position:absolute;
        right:10%;
        top: 45%;
    }

    #forgotten-pass{
        width: 0;
        height:0;
        overflow:hidden;
        transform: translateY(150%);
    }

    #forgotten-pass.active{
        width: 100%;
        color: white;
        background-color: var(--primary);
        padding: 0% 10% 0 10%;
        z-index: 15;
        transition: all .5s ease;
        transform: translateY(0%);
        transition: all .5s ease;
    }

    #forgotten-pass.active .text{
        text-align: center;
    }
    #forgotten-pass.active .text h2{
        font-size: 2em;
        width: 100%;
    }

    #forgotten-pass.active .text img{
        width: 20%;
        height: 10%;
        margin: 0 0 5% 0;
        object-fit: center;
    }

    #forgotten-pass.active .text p{
        font-size: 1em;
    }
    #forgotten-pass.active form .input-container{
        border-radius: 10px;
        margin: 0 0 5% 0;
        overflow: hidden;
        width:100%;
    }

    #forgotten-pass.active form .btns button:nth-child(1){
        margin: 0 0 2% 0;
    }

    #forgotten-pass.active form .btns button:nth-child(3){
        margin: 2% 0 0 0;
    }

    #forgotten-pass.active form{
        background-color: var(--block);
        border-radius: 10px;
        margin: 10% 0 0 20%;
        padding: 10% 5% 0 5%;
        width: 60%;
        height:60%;
    }

    #profile{
        width: 100%;
        height: 100%;
        color:white;
        background-color: var(--primary);
        transform: translateX(-100%);
        transition: transform .5s ease;
        padding: 0 0 0 0;
        overflow:hidden;
    }

    #profile.active{
        transform: translateX(0);
        z-index:3;
        transition: transform .5s ease;
    }

    #profile .profile-head{
        height:25%;
        width: 100%;
        margin: 0 0 5% 0;
        padding: 5% 0 0% 0;
    }

    #profile .profile-head img{
        width: 15%;
        height:30%;
        margin: 0 0 5% 45%;
        padding: 0% 0 0% 0;
        object-fit: cover;
    }

      #profile .profile-head .text{
        width: 35%;
        height: 65%;
        padding: 0 0 0 0;
        margin: 0% 0 0% 35%;
        text-align: center;
    }

    #profile .btn-continue{
        background-color: orange;
        height: 5vh;
        width: 15%;
        text-align: center;
        padding: 0 0 0 0;
        margin: 0 0 0 43%;
        border-radius:10px;
        color: var(--border);
        font-weight: 600;
        font-size: 1.2em;
        z-index: 1;
    }

    #profile .overlay-btn{
        height: 8vh;
        width: 100%;
        background: var(--primary);
        opacity: 0.7;
        z-index: 10;

    }
    #profile .overlay-btn.unactive{
        height: 0;
        width: 0;
        overflow:hidden;
    }

    #profile .btn-continue, #profile .overlay-btn{
        position:absolute;
        bottom: 5%;
    }

     #profile .btn-continue{
        cursor:pointer;
     }

    #profile .profiles{
        display: flex;
        justify-content: center;
        padding: 0 0 0 4%;
        height: 60%;
    }

    #profile .profiles svg{
        width:40px;
        height:60px;
        fill:white;
        transition: fill .5s ease;
        margin: 0 0 1% 5%;
    }

    #profile .profiles .learner, #profile .profiles .teacher{
        padding: 0 0 0 5%;
        position:relative;
        height:80%;
        width: 70%;
        margin: 0 0 0 0;
    }

    #profile .profiles .profile-teacher, #profile .profiles .profile-learner{
        border-radius:20px;
        z-index: 10;
        background-color: var(--border);
        width: 80%;
        height:100%;
        
    }

    #profile .profiles .profile-teacher img, #profile .profiles .profile-learner img{
        width: 90%;
        height: 50%;
        border-radius: 10px;
        z-index: 16;
        margin: 0 0 5% 5%;
        object-fit: cover;
    }

    #profile .profiles .profile-teacher .text, #profile .profiles .profile-learner .text{
        width:80%;
        max-height:25%;
        font-size: .8em;
        overflow:hidden;
        margin: 0 0 1% 5%;
    }

     #profile .profiles .profile-teacher.active, #profile .profiles .profile-learner.active{
        border: 1px solid orange;
        background: rgba(139, 73, 20, 0.14);
        opacity: 1;

    }

    #profile .profiles .profile-teacher.active svg, #profile .profiles .profile-learner.active svg{
        fill:orange;
        transition: all .5s ease;
    }

    #profile .profiles .profile-teacher.active img, #profile .profiles .profile-learner.active img, #profile .profiles .profile-teacher.active .text, #profile .profiles .profile-learner.active .text{
        z-index: 2000;
        transition:all .5s ease;
    }


    #loader-overlay.active #restore-pass{
        widtH:0;
        height:0;
        overflow:hidden;
    }
    #loader-overlay.active #restore-pass.active{
        width: 30%;
        height:auto;
        z-index:17;
        padding: 1% 1% 0 1%;
        text-align: center;
        border-radius: 10px;
        background-color: var(--block);
        color:white;
    }

    #loader-overlay.active #restore-pass.active p{
        padding: 0 5% 0 5%;
        margin: 1% 0 2% 0;
    }

    #restore-pass.active .useremail{
        font-weight:600;
        color: orange;
    }

    #restore-pass .goBack-btn{
        padding: 1% 0 1% 0;
        margin: 0 0 5% 2.5%;
        width: 95%;
        border-radius: 10px;
        border:none;
        background-color: var(--border);
        height:5%;
        color: white;
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const main = document.querySelector('main');
        const registerForm = document.querySelector('.register');
        const loginForm = document.querySelector('.login');
        const btnRegister = document.querySelector('.register .btns .btn-register');
        const btnLogin = document.querySelector('.register .btns .btn-login');
        const btnLogin2 = document.querySelector('.login .btns .btn-login');
        const btnRegister2 = document.querySelector('.login .btns .btn-register');
        const message = document.querySelector('#message');
        const success = document.querySelector('.success');
        const error = document.querySelector('.error');
        const successMsg = document.querySelector('.success-msg');
        const errorMsg = document.querySelector('.error-msg');
        const btnCloseMsg = document.querySelectorAll('.close-msg');
        const loaderOverlay = document.querySelector('#loader-overlay');
        const loader = document.querySelector('#loader-overlay .loader');
        const restorePass = document.querySelector('.restore-pass');
        const forgottenPass = document.querySelector('#forgotten-pass');
        const forgottenBtnConfirm = document.querySelector('#forgotten-pass .forgotten.btn-confirm');
        const forgottenBtnRegister = document.querySelector('.forgotten.btn-register');
        const emailForgot = document.querySelector('#email-forgotten');
        const profile = document.querySelector('#profile');
        const teacher = document.querySelector('#profile .profiles .profile-teacher');
        const learner = document.querySelector('#profile .profiles .profile-learner');
        const proContOverlayBtn = document.querySelector('#profile .overlay-btn');
        const proBtnContinue = document.querySelector('#profile .btn-continue');
        const restorePassword = document.querySelector('#restore-pass');
        const goBackBtn = document.querySelector('#restore-pass .goBack-btn');
        const spanRestorePass = document.querySelector('#restore-pass p .useremail');
        const restoreText = document.querySelector('#restore-pass p');
        
        goBackBtn.addEventListener('click', (e)=>{
            e.preventDefault();
            loaderOverlay.classList.remove('active');
            restorePassword.classList.remove('active');
            forgottenPass.classList.remove('active');
        })

        forgottenBtnConfirm.addEventListener('click', (e)=>{
            e.preventDefault();
            const token = "{{ csrf_token() }}";
            const email = emailForgot?.value;
            loaderOverlay.classList.add('active');
            loader.classList.add('active');
            $.ajax({
                url: '/resetPassword',
                headers: {
                    'X-CSRF-TOKEN' : token,
                    'Content-Type' : 'application/json',
                },
                data: JSON.stringify({
                    'email' : email,
                }),
                type: 'POST',
                success: function(response){
                    email.value=null;
                    console.log('restore-pass classlist:',restorePassword.classList);
                    console.log('loader-classlist: ', loader.classList);
                    
                    if(response.status==200){
                        loader.classList.remove('active');
                        restorePassword.classList.add('active');
                        spanRestorePass.innerText = email;
                        restoreText.innerText = restoreText.innerText;
                        
                    }else if(response.status==400){
                        loader.classList.remove('active');
                        restoreText.innerText = response.message;
                        loaderOverlay.classList.add('active');
                        restorePassword.classList.add('active');
                    }
                },

                error: function(error){

                }
            });
        });

        proBtnContinue.addEventListener('click', (e)=>{
            loaderOverlay.classList.add('active');
            loader.classList.add('active');
            const token = "{{ csrf_token() }}";
            console.log(token);


            $.ajax({
                url: '/userRole',
                data: JSON.stringify({
                    'profile': teacher.classList.contains('active')? 'formateur' : 'apprenant',
                }),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                },
                success: function(response){
                    if(response.redirect){
                        window.location.href = response.redirect;
                    }
                },
                error: function(error){
                    
                },
            })
        });
        teacher.addEventListener('click', (e)=>{
            e.preventDefault();
            console.log(teacher.classList)
            if(teacher.classList.contains('active')){
                teacher.classList.remove('active');
                if(proContOverlayBtn.classList.contains('unactive'))proContOverlayBtn.classList.remove('unactive');
                proContOverlayBtn.classList.add('active');
                return;
            }else{
                teacher.classList.add('active');
                if(learner.classList.contains('active')) learner.classList.remove('active');
                if(proContOverlayBtn.classList.contains('active')) proContOverlayBtn.classList.remove('active');
                proContOverlayBtn.classList.add('unactive');
            }
            
        });

        learner.addEventListener('click', (e)=>{
            e.preventDefault();
            console.log(learner.classList)
            if(learner.classList.contains('active')){
                learner.classList.remove('active');
                if(proContOverlayBtn.classList.contains('unactive'))proContOverlayBtn.classList.remove('unactive');
                proContOverlayBtn.classList.add('active');
                return;
            }else{
                learner.classList.add('active');
                proContOverlayBtn.classList.add('active');
                if(teacher.classList.contains('active')) teacher.classList.remove('active');
                if(proContOverlayBtn.classList.contains('active')) proContOverlayBtn.classList.remove('active');
                proContOverlayBtn.classList.add('unactive');
            }
        });

      

        forgottenBtnRegister.addEventListener('click', (e)=>{
            e.preventDefault();
            forgottenPass.classList.remove('active');
            registerForm.classList.remove('active');
        });

        restorePass.addEventListener('click', (e)=>{
            e.preventDefault();   
            console.log('clické!');         
            forgottenPass.classList.add('active');
        });     

        btnCloseMsg.forEach(btn =>{
            btn.addEventListener('click', (e)=>{
                e.preventDefault();
                e.currentTarget.parentNode.classList.remove('active');
                e.currentTarget.parentNode.parentNode.classList.remove('active');
            })
        })
        btnRegister2.addEventListener('click', (e)=> {
            e.preventDefault();
            if(registerForm.classList.contains('active')) registerForm.classList.remove('active');
        });

        // Soumission du formulaire de login
        btnLogin2.addEventListener('click', (e)=> {
            e.preventDefault();
            const logEmail = document.querySelector('#log-email')?.value;
            const logPassword = document.querySelector('#log-password')?.value;
            const token = "{{ csrf_token() }}";
            loaderOverlay.classList.add('active');
            loader.classList.add('active');
            $.ajax({
                type : 'POST',
                url: "{{ route('login') }}",
                timeout: 10000, // 10 secondes de timeout
                headers: {
                    'X-CSRF-TOKEN' : token,
                    'Content-Type' : 'application/json',
                    'Accept' : 'application/json'
                },
                data : JSON.stringify({
                    'email': logEmail,
                    'password': logPassword,
                }),

                success: function(response){
                    if(response.redirect){
                        loader.classList.remove('active');
                        loaderOverlay.classList.remove('active');
                        window.location.href = response.redirect;
                    // // Nettoyer les états précédents
                    // if(loaderOverlay.classList.contains('active')) loaderOverlay.classList.remove('active');
                    // if(loader.classList.contains('active')) loader.classList.remove('active');
                    // if(error.classList.contains('active')) error.classList.remove('active');
                    // if(message.classList.contains('error')) message.classList.remove('error');
                    
                    // // Afficher le succès
                    // successMsg.innerText = response.message;
                    // message.classList.add('success');
                    // success.classList.add('active');

                }else{
                    loaderOverlay.classList.remove('active');
                    loader.classList.remove('active');
                    success.classList.remove('active');
                    message.classList.remove('success');
                    
                    let errorMessage = response.message;
                    console.log(errorMessage);
                    // Afficher l'erreur
                    errorMsg.innerText = errorMessage;
                    error.classList.add('active');
                    message.classList.add('error');
                }},
                error: function(erreur){
                    
                    // Nettoyer les états précédents
                    loaderOverlay.classList.remove('active');
                    loader.classList.remove('active');
                    success.classList.remove('active');
                    message.classList.remove('success');
                    
                    let errorMessage = erreur.responseJSON.message;
                    console.log(errorMessage);
                    // Afficher l'erreur
                    errorMsg.innerText = errorMessage;
                    error.classList.add('active');
                    message.classList.add('error');
                }
            })

            


        });
        // Soumission du formulaire de register
        btnRegister.addEventListener('click', (e)=> {
            e.preventDefault();
            // Validation côté client
            const email = document.querySelector('#email')?.value;
            const password = document.querySelector('#password')?.value;
            const confirm_password = document.querySelector('#confirm_password')?.value;
            const name = document.querySelector('#username')?.value;

            const token = "{{ csrf_token() }}";
            loaderOverlay.classList.add('active');
            loader.classList.add('active');

            $.ajax({
                url : "{{ route('register') }}",
                type : "POST",
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept' : 'application/json'
                },
                data : JSON.stringify({
                    'email' : email,
                    'password' : password,
                    'confirm_password' : confirm_password,
                    'username' : name,
                }),

                success : function(response){   
                    if(response.status == 200){
                    // Nettoyer les états précédents
                    if(loaderOverlay.classList.contains('active')) loaderOverlay.classList.remove('active');
                    if(loader.classList.contains('active')) loader.classList.remove('active');
                    if(error.classList.contains('active')) error.classList.remove('active');
                    // 
                    // Afficher le succès
                    successMsg.innerText = response.message;
                    message.classList.add('success');
                    success.classList.add('active');
                    profile.classList.add('active');                    
                        
                }else if (response.status == 422){
                    loaderOverlay.classList.remove('active');
                    loader.classList.remove('active');
                    success.classList.remove('active');
                    message.classList.remove('success');
                    let errorMessage = 'Erreur d\'inscription';
                    
                    errorMessage = response;
                    console.log(errorMessage);
                    // Afficher l'erreur
                    errorMsg.innerText = errorMessage;
                    message.classList.add('error');
                    error.classList.add('active'); 
                }
                },
                error: function(errors){
                    console.log(error);
                    console.log(message)
                    // Nettoyer les états précédents
                    loaderOverlay.classList.remove('active');
                    loader.classList.remove('active');
                    success.classList.remove('active');
                    message.classList.remove('success');
                    let errorMessage = 'Erreur d\'inscription';
                    
                    errorMessage = errors.responseJSON.message;
                    console.log(errorMessage);
                    // Afficher l'erreur
                    errorMsg.innerText = errorMessage;
                    message.classList.add('error');
                    error.classList.add('active');
                }   
            })
            
        });

        btnLogin.addEventListener('click', (e)=> {
            e.preventDefault();
            registerForm.classList.add('active');
        });
    });
</script>
@section('content')
    <section id="blockpage">
        <div class="container-left">
                <div class="block"><img src="{{ asset('images/image4.png')}}" alt=""></div>
                <div class="block"></div>
                <div class="block"></div>
                <div class="block"></div>
            </div>
            <div class="overlay" >
                <img src="https://www.bintschool.com/wp-content/uploads/2023/04/BintSchooloff.png" alt="" class="logo">
                <div class="register">
                    <div class="register-head">
                        <h1>Créer un nouveau compte</h1>
                        <p>Renseignez ces champs pour acceder immédiatement aux cours</p>
                    </div>
                    <form action="">
                        @csrf
                        <div class="input-container">
                            <input type="text" id="username" name="username" placeholder="Nom Complet" required>
                        </div>
                        <div class="input-container">
                            <input type="text" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-container">
                            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                        </div>
                        <div class="input-container">
                            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
                        </div>
                        <div class="btns">
                            <button class="btn-register">Creer un compte</button>
                            <div>ou</div>
                            <button class="btn-login">Se connecter</button>
                        </div> 
                    </form>
                </div>
                <div class="login">
                    <div class="login-head">
                        <h1>Se connecter</h1>
                        <p>Renseignez ces champs pour acceder immédiatement aux cours</p>
                    </div>
                    <form action="">
                        @csrf
                        <div class="input-container">
                            <input type="text" id="log-email" name="email" placeholder="Email" required>
                        </div>
                        <div class="input-container">
                            <input type="password" id="log-password" name="password" placeholder="Mot de passe" required>
                        </div>
                        <a class="restore-pass"href="">Mot de passe oublié ?</a>
                        <div class="btns">
                            <button class="btn-login">Se connecter</button>
                            <div>ou</div>
                            <button class="btn-register">Créer un nouveau compte</button>
                        </div>
                        
                    </form>
                </div>
                <div id="forgotten-pass">
                    <div class="text">
                        <h2>Réinitialiser votre mot de passe</h2>
                        <p>Renseignez votre email afin de réinitialiser votre mot de passe</p>
                    </div>
                    <form action="">
                        <div class="input-container">
                            <input type="text" id="email-forgotten" name="email-forgotten" placeholder="Email" required>
                        </div>
                        
                        <div class="btns">
                            <button class="forgotten btn-confirm">continuer</button>
                            <div>ou</div>
                            <button class="forgotten btn-register">créer un nouveau compte</button>
                        </div>
                    </form>
                </div>

                <div id="profile">
                    <div class="profile-head">
                        <div class="text">
                            <h5>Définir votre profil</h5>
                            <p>Renseignez ces champs pour acceder immediatement aux cours</p>
                        </div>
                    </div>
                    <div class="profiles">
                        <div class="teacher">
                            <div class="profile-teacher">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-shop" viewBox="0 0 16 16"><path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.37 2.37 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/></svg>
                                <div class="text">
                                    <h4>Formateur</h4>
                                    <p>Présentez et vendez des cours aux apprenants</p>
                                </div>
                                <img src=" {{asset('images/image2.png') }} " alt="">
                            </div>
                        </div>
                            
                        <div class="learner">
                            <div class="profile-learner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-mortarboard" viewBox="0 0 16 16"><path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/><path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"/></svg>
                                <div class="text">
                                    <h4>Apprenant</h4>
                                    <p>Découvrez et apprenez des cours</p>
                                        
                                </div>
                                <img src=" {{ asset('images/image3.png') }} " alt="">
                            </div>
                        </div>
                            
                    </div>

                        <div class="overlay-btn"></div>
                        <div class="btn-continue">continuer</div>
                    </div>

            </div>
            <div class="container-right">
                <div class="block"></div>
                <div class="block"><img src="{{ asset('images/image3.png')}}" alt=""></div>
                <div class="block"></div>
                <div class="block"></div>
            </div>
            
            
        </div>


        
</section>
<section id="message">
    <div class="success">
        <h4>Réussi</h4>
        <div class="success-msg"></div>
        <button class="close-msg">fermer</button>
    </div>

    <div class="error">
        <h4>Error</h4>
        <div class="error-msg"></div>
        <button class="close-msg">fermer</button>
    </div>
</section>
<section id="loader-overlay">
    <div class="loader">
        Veuillez patienter...
        <div class="spinner">
            <div class="top"></div>
            <div class="left"></div>
            <div class="right"></div>
            <div class="bottom"></div>
        </div>
    </div>

    <div id="restore-pass">
        <h2>Message</h2>
        <p>Le mail de réinitialisation a été envoyé sur votre adresse <span class="useremail"></span>.Consulter le dès maintenant afin d'acceder a votre compte</p>
        <button class="goBack-btn">Revenir à la page de connexion</button>
    </div>
</section>
    
@endsection