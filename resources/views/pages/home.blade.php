@extends('index')

@section('content')
    <style>
        :root{
            --primary:rgba(5,7,21,255);
            --border: #222430;
            --block: rgba(27, 29, 50, 1);
            --lite: rgba(197, 199, 222, 1);
            --secondary: #1B1B1B;
            --graylite: #353535ff;
        }
        html,body{
            height:100%;
        }

        main{
            position:fixed;
            top:0;
            height:100%;
        }

        #blockpage{
            display:flex;
            position:relative;
            flex: 10;
        }

        nav{
            position:sticky;
            background-color: var(--primary);
            color: white;
            height:100%;
            width:20%;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: space-evenly;
            padding: 0 0 1% 0;
            color: var(--lite); 
            min-height:100%;
            flex:2;
        }
        
        nav img{
            width: 60%;
            margin: 0 0 0 10%;
        }

        nav .pages{
            height: 70%;
        }
        nav ul{
            color: orange;
            height:100%;
            display:flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        nav ul li{
            color: var(--lite);
            height: 8%;
            width:85%;
            display:flex;
            justify-content: flex-start;
            align-items: center;
            border-radius:10px;
            padding: 0 0 0 5%;
            margin: 5% 0 2% 0;
            cursor:pointer;
            list-style-type: none;
            position:relative;
            transition: all .5s ease;
            
        }

        nav ul li.active{
            padding: 0 0 0 10%;
            color:orange;
            border:1px solid orange;
            transition: all .5s ease;
        }

        nav ul li.active::before{
            content: '';
            position:absolute;
            left: 5%;
            width: 5px;
            height: 5px;
            border-radius: 50px;
            background-color:orange;
        }

        nav ul li svg{
            width:20px;
            height:20px;
            fill:white;
            stroke:white;
            margin: 0 5% 0 0;
        }

        #logout{
            margin: 0 5% 0 5%;
            padding: 0 0 0 5%;
            border-radius: 10px;
            background-color: var(--block);
            height: 5vh;
            color: var(--lite);
            border:none;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 5%;
            font-size: 1.2em;
        }

        #logout svg{
            width: 30px;
            height:30px;
            fill: var(--lite);
        }

        #home{
            display:flex;
            background-color: var(--secondary);
            flex:10;
            z-index: 2;
            padding: 0% 0 2% 0;
        }

        #home #categories ul{
            color: orange;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            width:90%;
            height:100%;
            padding: 10% 0 5% 5%;
            overflow-y: scroll;
            scrollbar-width:none;
        }

        #categories ul li{
            width:100%;
            color: #797979ff;
            list-style-type: none;
            cursor:pointer;
            margin: 0 0 0 10%;
            position: relative;
        }

        #categories ul li.active{
            color: white;
        }

        #home #categories ul li.active::before{
            background-color:orange;
            transition: background-color .5s ease;
            width:10px;
            height:20px;
        }
        
        #home #categories ul li::before{
            content: '';
            transition: background-color .5s ease;
            position: absolute;
            left:-10%;;
            border-radius: 10px;
            margin: 0 20% 0 0;
            width:10px;
            height:20px;
            background-color:white;
        }

        #categories{
            flex:2;
            overflow: hidden;
        }


        #home aside{
            flex:3;
            display:flex;
            flex-direction: column;
            justify-content:space-between;
            align-items: center;
        }

        #home aside .search{
            width: 85%;;
            display:flex;
            justify-content: space-between;
            align-items: center;
            margin: 5% 0 0 0;
        }

        #home aside .search .input-container{
            display:flex;
            justify-content:space-around;
            align-items:center;
            border-radius:15px;
            width: 73%;
            height: 6vh;
            padding: 0 0 0 4%;
            border:2px solid #8a8a8aff;
        }

        #home aside .search .input-container input{
            background-color: var(--secondary);
            border:none;
            width:80%;
            height:90%;
            color:white;
        }

        #home aside .search .input-container input:focus{
            outline:none;
            color:white;
        }

        #home aside .search .btn-search{
            height:100%;
            border-radius: 10px;
            font-weight:400;
            background-color: orange;
        }

        #home aside .search .input-container svg{
            fill:white;
            width:25px;
            height:25px;
        }

        #suggestions{
            height:100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5%;
            align-items: center;
            overflow-y: scroll;
            margin: 5% 0 0 0;
            scrollbar-width:none;
        }

        #suggestions .video{
            width: 40%;
            height:45%;
            border-radius: 10px;
            border: 1px solid white;
            margin: 0 0 3% 0;
            position:relative;
        }

        #suggestions .video svg{
            fill:white;
            height:50px;
            width:50px;
            position:absolute;
            top:40%;
            left:35%;
            z-index: 2;
        }

        #content{
            overflow-y: scroll;
            scrollbar-width:none;
            padding: 1% 0 0 0;
            flex:3;
        }

        #content .content-item{
            position:relative;
        }

        #content .content-item .text, #content .content-item video{
            position:absolute;
        }
        #content .content-item{
            width: 100%;
            height:90%;
            border-radius: 20px;
            overflow: hidden;
            margin: 5% 0 0 0;
        }

        #content .content-item .text{
            background: linear-gradient(to top, var(--primary), transparent);
            color:white;
            z-index:2;
            height:35%;
            width: 100%;
            bottom:10%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            
        }
        
        #content .content-item video{
            width:100%;
            height:90%;
            object-fit:cover;
        }

        #content .content-item .text .user{
            height: 25%;
            width: 80%;
            display:flex;
            flex-direction: row;
            gap:5%;
            justify-content: flex-start;
            align-items: center;
            margin: 0 0 1% 5%;
        }

        #content .content-item .text .user .btn-follow{
            font-size: 1.1em;
        }

        #content .content-item .text .user button{
            border:none;
            opacity: .7;
            padding: 1% 2% 1% 2%;
            border-radius: 5px;
            background-color:white;
        }

        #content .content-item .text .user .info{
            max-height: 100%;
            display:flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }
        #content .content-item .text .user img{
            width: 15%;
            height:100%;
            object-fit:cover;
            border-radius:50px;
        }

        #content .content-item .text p{
            max-height:5vh;
            max-width:85%;
            padding: 0 0 0 5%;
            overflow:hidden;
            font-size: .8em;
        }

        #content .content-item .text .btns{
            width: 40%;
            height:20%;
            max-width:40%;
            max-height:20%;
            display:flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            margin: 0 0 0 55%;
        }

        #content .content-item .text .btns button{
            width: 30%;
            height:90%;
            max-height:90%;
            backdrop-filter:  blur(1px);
            background-color:transparent;
            border:none;
        }

        #content .content-item .text .btns button svg{
            fill:white;
            width:25px;
            height:25px;
        }

        #content .content-item .text .btns button::before{
            background-color:white;
            opacity: 0.5;
            content: '';
        }


        #content .content-item .text .more{
            max-height: 30%;
            position:absolute;
            bottom: 0;
            display:flex;
            justify-content: space-around;
            align-items: center
        }

        #content .content-item .text .more p{
            max-width: 50%;
            overflow:hidden;
            margin: 2% 0 2% 0;
            padding: 0 0 0 0;
        }

        #content .content-item .text .more button{
            background-color:orange;
            border:none;
            width:20%;
            height: 5vh;
            border-radius: 5px;
            color:black;
        }

        #content .content-item .pause svg{
            position:absolute;
            top:35%;
            left:40%;
            fill:white;
            width:100px;
            height:100px;
            
        }

        #content .content-item .pause.active{
            opacity: 1;
            transition: opacity .5s ease;
        }

        #content .content-item .pause.unactive{
            opacity: 0;
            transition: opacity .5s ease;
        }

        #profile, #home{
            height:100%;
            position: absolute;
        }

        #profile{
            color:white;
            background-color: var(--secondary);
            width: 0%;
            padding: 5% 10% 0 10%;
            transform: translateX(110%);
            transition: transform .5s ease;
            overflow-y: scroll;
            scrollbar-width:none;
        }

        #profile.active{
            width: 100%;
            z-index:5;
            transform: translateX(0);
            transition: transform .5s ease-out;
        }


        #profile .user{
            height: 70%;
            max-height:70%;
            position:relative;
            padding: 0 0 5% 0;
            border-bottom: 2px solid gray;
        }

        #profile .user .cover{
            height:35vh;
            border-radius: 20px;
            overflow: hidden;
        }

        #profile .user .cover img{
            height:100%;
            width:100%;
            object-fit:cover;
        }

        #profile .user .user-profile{
            display:flex;
            justify-content: space-between;
            height:55%;
            position:absolute;
            bottom: 1%;
        }

        #profile .user .user-profile .user-info{
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            height:100%;
            padding: 0 0 0 3%;
            flex:3;
        }

        #profile .user .user-profile .user-info img{
            border:5px solid white;
            height:40%;
            width:20%;
            border-radius: 50%;
            object-fit: cover;
        }

        #profile .user .user-profile .user-info p{
            overflow:hidden;
            max-height:5vh;
            width:65%;
        }

        #profile .user .user-profile .followers{
            font-size:1.1em;
            font-weight:500;
            width: 100%;
            height:5vh;
            display: flex;
            justify-content: space-evenly;
            align-items: center;
        }

        #profile .user .user-profile .followers span{
            color: gray;
        }

        #profile .user .user-profile .btns{
            flex:2;
            display:flex;
            justify-content: space-between;
            align-items: center;
        }

        #profile .user .user-profile .btns button{
            border:none;
            width:30%;
            height:15%;
            font-size:1.1em;
            font-weight:500;
            border-radius:5px;
        }

        #profile .complete-profil{
            height:40%;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: space-between;
            padding: 2% 0 5% 0;
            border-bottom: 2px solid gray;
        }


        #profile .complete-profil .block1, #profile .complete-profil .block2 {
            display:flex;
            justify-content: space-between;
            align-items:center;
            padding: 0% 1% 0 1%;
        }

        #profile .complete-profil .block1, #profile .complete-profil .block2 .block2-item{
            width:50%;
            height:100%;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        #profile .complete-profil .block1{
            height:70%;
            width:100%;
            border-radius: 20px;
            margin: 0 0 2% 0;
            padding: 1% 1% 1% 1%;
            background-color: var(--graylite);
        }

        #profile .complete-profil .block1 .congratulations{
            border:1px solid gray;
            padding: 1% 0 0 0;
            width: 25%;
            text-align:center;
            border-radius:15px;
        }

        #profile .complete-profil .block1 .congratulations svg{
            height:50px;
            width:50px;
            margin: 0 5% 0 0;
            fill:white;
            border-radius:100px;
            background-color: green;
            box-shadow: rgba(0, 0, 0, 1);
         }

        #profile .complete-profil .block2{
            border: 5px solid #4285F4;
            background-color: #4481e42b;
            border-radius: 20px;
            height:35%;
            position:relative;
        }


        #profile .complete-profil .block2 svg{
            height:50px;
            width:50px;
            fill: #4285F4;
        }

        #profile .complete-profil .block2 .send-link{
            width: 80%;
            padding: 1% 0 0 0;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        #profile .complete-profil .block2 .send-link .link-mail{
            display:flex;
            justify-content: space-around;
            width:90%;
        }

        #profile .complete-profil .block2 .send-link a{
            color: orange;
        }

        #profile .complete-profil .block2 button{
            height:70%;
            border: none;
            font-size: 1.1em;
            font-weight:500;
            border-radius: 10px;
        }

        #profile .complete-profil .percentage{
           width: 8%;
           height:10vh;
           border-radius: 100px;
           background: conic-gradient(greenyellow 80%, black 20%);;
           display:flex;
           justify-content: center;
           align-items: center;
        }

        #profile .complete-profil .percentage::before{
           content: '90%';
           font-size: 1.2em;
           display: flex;
           justify-content: center;
           align-items: center;
           padding: 10%;
           height:80%;
           width:80%;
           border-radius: 50%;
           background-color: var(--secondary);
        }

        #profile .complete-profil .block1 .checkboxs{
            width: 65%;
            height:100%;
            gap: 10%;
            display:flex;
            flex-direction: column;
            justify-content: center;
        }

        #profile .complete-profil .block1 .checkboxs h2{
            width:100%;
            padding: 0 0 0 5%;
        }

        #profile .complete-profil .block1 .checkboxs .checks{
            display:flex;
            width:100%;
            gap:1%;
        }

        #profile .complete-profil .block1 .checkboxs .checks .check-item{
            display:flex;
            width:33%;
            justify-content: space-evenly;
            align-items: center;
            font-size:1.1em;
        }

        #profile .complete-profil .block1 .checkboxs .checks .check{
            width: 30px;
            height:30px;
            margin: 0 1% 0 0;
            display:flex;
            justify-content: flex-start;
            background-color: greenyellow;
            border-radius:50px;
        }

        #profile .complete-profil .block1 .checkboxs .checks .check svg{
            height:100%;
            width:100%;
            fill: green;
        }

        #profile .complete-profil .center .checks-profil .checkboxs{
            display:flex;
        }

        #cours{
            width: 100%;
            margin: 2% 0 0 0;
            display:flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #cours .items{
            width:100%;
            height:30vh;
            display: flex;
            align-items:Center;
            flex-wrap: wrap;
            gap: 5%;
        }

        #cours ul{
            display: flex;
            justify-content: space-between;
            align-items:center;
            width:60%;
        }

        #cours ul li{
            font-size: 1.1em;
            font-weight: 500;
            list-style-type: none;
            padding: 1% 0 0 0;
            text-align:center;
            height: 4vh;
            width:30%;
            cursor: pointer;
            background-color: transparent;
            transition: backgroun-color .5s ease;
        }

        #cours ul li.active{
            border-radius: 15px;
            background-color: var(--graylite);
            transition: backgroun-color .5s ease-out;
        }

        #cours .cour{
            display:flex;
            justify-content: space-around;
            align-items: center;
            width: 45%;
            height:12vh;
            border-radius: 20px;
            background-color: var(--graylite);
            margin: 5% 0 0 0;
            padding: 0 0 0 1%;
        }

        #cours .cour img{
            flex:2;
            height:80%;
            border-radius: 10px;
            object-fit: cover;
        }

        #cours .cour .text{
            flex:6;
            display:flex;
            flex-direction: column;
            justify-content: space-around;
        }

        #cours .cour .text h4{
            width:100%;
            padding: 0 0 0 5%;
        }

        #cours .cour .text .meta-info{
            display:flex;
            justify-content: space-around;
            align-items: flex-end;
            width: 100%;
            color: gray;
        }

        #cours .cour .text .meta-info .hour{
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .5);
            text-align:center;
            width:20%;
            border-radius: 50px;
        }

        #cours .cour .text .meta-info .cour-cate{
            width:20%;
            text-align: center;
            border-radius: 50px;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .5);
        }

        #cours .cour .text .meta-info .publisher{
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, .5);
            border-radius: 50px;
            display:flex;
        }

        #cours .cour .text .meta-info .publisher img{
            width:30%;
            height:10%;
            border-radius: 100px;
            object-fit:cover;
        }

        #inputs{
            width:0;
            height:0;
        }

        #profile-pic, #cover-pic{
            display:none;
        }

        #overlay{
            height:0;
            width:0;
            z-index: -1;
            transition: height .5s ease;
            overflow: hidden;
        }

        #overlay.active{
            position:fixed;
            top:0;
            height:100%;
            width: 100%;
            z-index: 6;
            background-color: rgba(0, 0, 0, .5);
            transition: height .5s ease;
            display: flex;
            justify-content: flex-end;
            padding: 0 17% 0 0;
        }

        #params{
            height:100%;
            width:30%;
            transform: translateX(100%);
            transition: transform .5s ease;
            background-color: var(--secondary);
        }

        #params.active{
            height:100%;
            width:30%;
            padding: 0 0 0 2%;
            background-color: var(--secondary);
            transform: translateX(0);
            transition: transform .5s ease;
        }

        #params .param-head{
            width:100%;
            height:8%;
            color:white;
            border-bottom: 1px solid var(--graylite);
            display:flex;
            justify-content: space-between;
            align-items: center;
        }

        #params .param-head .btn-close-param{
            background-color: var(--graylite);
            border-radius: 50%;
            width:10%;
            height:60%;
            display: flex;
            justify-content: center;
            align-items: center;
            border:none;
        }

        #params .param-head .btn-close-param svg{
            height:100%;
            width:100%;
            fill:white;
        }


    </style>

    <script>

        document.addEventListener('DOMContentLoaded', function(){
            const pauses = document.querySelectorAll('.pause');
            const listes = document.querySelectorAll('#categories ul li');
            const main = document.querySelector('main');
            const navList = document.querySelectorAll('nav ul li');
            const profilePage = document.querySelector('#profile');
            const profileLink = document.querySelector('nav ul li.profile-link');
            const pourToi = document.querySelector('nav ul li.pour-toi');
            const messagerie = document.querySelector('nav ul li.messagerie');
            const formaSuivie = document.querySelector('nav ul li.forma-suivie');
            const btnParam = document.querySelector('#profile .user .user-profile .btns .param');
            const btnShare = document.querySelector('#profile .user .user-profile .btns .profile-share');
            const btnChangeCover = document.querySelector('#profile .user .user-profile .btns .change-cover');
            const coverPic = document.querySelector('#cover-pic');
            const profilePic = document.querySelector('#profile-pic');
            const overlay = document.querySelector('#overlay');
            const params = document.querySelector('#params');
            const closeParam = document.querySelector('#params .param-head .btn-close-param');
            const coursLi = document.querySelectorAll('#cours ul li');

            // Animation on les active cour element

            coursLi.forEach((courLi) =>{
                courLi.addEventListener('click', (e)=>{
                    e.preventDefault();
                    const active = document.querySelector('#cours ul li.active');
                    if(active) active.classList.remove('active');
                    if(e.currentTarget.classList.contains('active')) return;
                    e.currentTarget.classList.add('active');
                });
            });

            main.style.cssText += 'display:flex; width:100%; height:100%;';

            // Appear the params & close params

            btnParam.addEventListener('click', (e)=>{
                e.preventDefault();
                if(! overlay.classList.contains('active')) overlay.classList.add('active');
                if(! params.classList.contains('active')) params.classList.add('active');
            });

            closeParam.addEventListener('click', (e)=>{
                params.classList.remove('active');
                overlay.classList.remove('active');
            });

            // Change the profile and cover picture

            btnChangeCover.addEventListener('click', (e)=> {
                e.preventDefault();
                coverPic.click();
            });

            // btnChangeCover.addEventListener('click', (e)=> {
            //     e.preventDefault();
            //     coverPic.click();
            // });

            // Appear the home page

            pourToi.addEventListener('click', (e)=>{
                e.preventDefault();
                if(pourToi.classList.contains('active')) return;
                if(profileLink.classList.contains('active')) profileLink.classList.remove('active');
                if(profilePage.classList.contains('active')) profilePage.classList.remove('active');
                if(messagerie.classList.contains('active')) messagerie.classList.remove('active');
                if(formaSuivie.classList.contains('active')) formaSuivie.classList.remove('active');
                pourtoi.classList.add('active');
            });

            // Make the profile page appear

            profileLink.addEventListener('click', (e)=>{
                e.preventDefault();
                if(profileLink.classList.contains('active')) return;
                profilePage.classList.add('active');
            })

            // Animate the nav element

            navList.forEach(li =>{
                li.addEventListener('click', (e)=>{
                    e.preventDefault();
                    const pageListActive = document.querySelector('nav ul li.active');
                    if(pageListActive?.classList.contains('active')) pageListActive?.classList.remove('active');
                    if(e.currentTarget.classList.contains('active')) return;
                    e.currentTarget.classList.add('active');
                                  
                });
            });

            listes.forEach(liste =>{
                liste.addEventListener('click', (e)=>{
                    e.preventDefault();
                    const liActive = document.querySelector('#categories ul li.active');
                    if(liActive?.classList.contains('active')) liActive?.classList.remove('active');
                    if(e.currentTarget.classList.contains('active')){
                        e.currentTarget.classList.remove('active');
                        return;
                    }
                    
                    e.currentTarget.classList.add('active');
                });
            });

            // Play the video on the pause button's click 
            pauses.forEach(pause =>{
                pause.addEventListener('click', (e)=>{
                    e.preventDefault();
                    const video = pause.previousElementSibling;
                    if(pause.classList.contains('active')) pause.classList.add('unactive');
                    video.play();
                });

            });


        });

    </script>

    <nav>
        <div class="nav-head">
            <img src="https://www.bintschool.com/wp-content/uploads/2023/04/BintSchooloff.png" alt="" class="logo">
        </div>
        <div class="pages">
            <ul>
                MENU
                <li class="pour-toi active">
                    <svg xmlns="http://www.w3.org/2000/svg"  class="bi bi-house" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                    Pour toi
                </li>

                <li class="profile-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    Profil
                </li>

                <li class="messagerie">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat-left-dots" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M5 6a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg>
                    Messagerie</li>
                <li class="forma-suivie">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-book-fill" viewBox="0 0 16 16">
                        <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                    </svg>    
                    Formation suivies
                </li>

            </ul> 
        </div>
        

        <button id="logout">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
            </svg>    
        Déconnexion</button>
    </nav>

    <div id="blockpage">
            <section id="home">
                <div id="categories">
                    <ul>CATEGORIES
                        <li class="active">Toutes les catégories</li>
                        <li>cat1</li>
                        <li>cat2</li>
                        <li>cat3</li>
                        <li>cat4</li>
                        <li>cat5</li>
                        <li>cat6</li>
                        <li>cat7</li>
                        <li>cat8</li>
                        <li>cat9</li>
                        <li>cat10</li>
                        <li>cat11</li>
                        <li>cat12</li>
                        <li>cat13</li>
                        <li>cat14</li>
                        <li>cat15</li>
                        <li>cat16</li>
                        <li>cat17</li>
                        <li>cat18</li>
                        <li>cat19</li>
                        <li>cat20</li>
                    </ul>
                </div>

                <div id="content">

                    <div class="content-item">
                        <video  muted poster="{{ asset('images/image2.png') }}" preload="auto">
                            <source src="#" type=""> </source>
                        </video>
                        <div class="pause">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        <div class="text">

                            <div class="user">
                                <img src=" {{ asset('images/image4.png') }}" alt="">
                                <div class="info">
                                    <h6>Username</h6>
                                    <div class="date">Date</div>
                                </div>
                                
                                <button class="btn-follow"> + suivre</button>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nobis, dolore distinctio quisquam aspernatur perspiciatis ducimus repellat aliquam numquam vero ut atque nisi eum, laborum libero reiciendis nam quas nulla!</p>
                            <div class="btns">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="more">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga iste eum, similique impedit doloremque repudiandae sequi quisquam quidem voluptates placeat sunt adipisci commodi iure magni eligendi omnis. Neque, sequi vel.</p>
                                <button>savoir</button>
                            </div>
                        </div>
                    </div>

                    <div class="content-item">
                        <video src="" width="80%" height="90%"  muted poster=" {{ asset('images/image1.png') }}" preload="auto"></video>
                        <div class="pause">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        <div class="text">

                            <div class="user">
                                <img src=" {{ asset('images/image4.png') }}" alt="">
                                <div class="info">
                                    <h6>Username</h6>
                                    <div class="date">Date</div>
                                </div>
                                
                                <button class="btn-follow"> + suivre</button>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nobis, dolore distinctio quisquam aspernatur perspiciatis ducimus repellat aliquam numquam vero ut atque nisi eum, laborum libero reiciendis nam quas nulla!</p>
                            <div class="btns">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="more">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga iste eum, similique impedit doloremque repudiandae sequi quisquam quidem voluptates placeat sunt adipisci commodi iure magni eligendi omnis. Neque, sequi vel.</p>
                                <button>Savoir +</button>
                            </div>
                        </div>
                    </div>

                    <div class="content-item">
                        <video src="" width="80%" height="90%"  muted poster="{{ asset('images/image3.png') }}" preload="auto"></video>
                        <div class="pause">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        <div class="text">

                            <div class="user">
                                <img src=" {{ asset('images/image4.png') }}" alt="">
                                <div class="info">
                                    <h6>Username</h6>
                                    <div class="date">Date</div>
                                </div>
                                
                                <button class="btn-follow"> + suivre</button>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nobis, dolore distinctio quisquam aspernatur perspiciatis ducimus repellat aliquam numquam vero ut atque nisi eum, laborum libero reiciendis nam quas nulla!</p>
                            <div class="btns">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="more">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga iste eum, similique impedit doloremque repudiandae sequi quisquam quidem voluptates placeat sunt adipisci commodi iure magni eligendi omnis. Neque, sequi vel.</p>
                                <button>Savoir +</button>
                            </div>
                        </div>
                    </div>

                    <div class="content-item">
                        <video src="" width="80%" height="90%"  muted poster="{{ asset('images/image4.png') }}" preload="auto">

                        </video>
                        <div class="pause">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        <div class="text">

                            <div class="user">
                                <img src=" {{ asset('images/image4.png') }}" alt="">
                                <div class="info">
                                    <h6>Username</h6>
                                    <div class="date">Date</div>
                                </div>
                                
                                <button class="btn-follow"> + suivre</button>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nobis, dolore distinctio quisquam aspernatur perspiciatis ducimus repellat aliquam numquam vero ut atque nisi eum, laborum libero reiciendis nam quas nulla!</p>
                            <div class="btns">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
                                    </svg>
                                </button>

                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chat" viewBox="0 0 16 16">
                                        <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                    </svg>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-send" viewBox="0 0 16 16">
                                        <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="more">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga iste eum, similique impedit doloremque repudiandae sequi quisquam quidem voluptates placeat sunt adipisci commodi iure magni eligendi omnis. Neque, sequi vel.</p>
                                <button>Savoir +</button>
                            </div>
                        </div>
                    </div>


                </div>

                <aside>
                    <div class="search">
                        <div class="input-container">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                            <input type="text" placeholder="Rechercher">
                        </div>
                        <button class="btn-search">Rechercher</button>
                    </div>

                    <div id="suggestions">
                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>

                        <div class="video">
                            <video src="#" muted poster="" preload="auto"></video>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                            </svg>
                        </div>
                        
                        <!-- <video src="#" muted poster="" preload="auto"></video>
                        <video src="#" muted poster="" preload="auto"></video>
                        <video src="#" muted poster="" preload="auto"></video>
                        <video src="#" muted poster="" preload="auto"></video>
                        <video src="#" muted poster="" preload="auto"></video> -->
                    </div>

                </aside>

            </section>


            
            <!-- Represent the profil page -->


            <section id="profile">

                <!-- Contain user information -->
                <div class="user">
                    <div class="cover">
                        <img src="https://images.pexels.com/photos/956999/milky-way-starry-sky-night-sky-star-956999.jpeg" alt="">
                    </div>

                    <div class="user-profile">
                        <div class="user-info">
                            <img src=" {{ asset('images/image4.png') }}" alt="">
                            <h2>Username</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Exercitationem, officia earum nihil, modi beatae consequuntur ea voluptatibus asperiores, enim magnam harum dolorum nobis doloremque deserunt sunt aliquid quisquam nulla. Nisi!</p>
                            <div class="followers">
                                <div><span>Followers: </span> 100 | </div> <div><span>Suivi: </span> 100  | </div> <div> <span class="profession">Developpeur</span></div>
                            </div>
                        </div>

                            <!-- Contain the buttons in the profil -->
                        <div class="btns">
                            <button class="change-cover">changer cover</button>
                            <button class="profile-share">Partage profil</button>
                            <button class="param">Paramètres</button>
                        </div>
                    </div>

                </div>

                <!-- This part represent the profil completion elements -->

                <div class="complete-profil">

                    <div class="block1">
                        <div class="percentage"> <!-- contain percentage --> </div>

                        <div class="checkboxs">
                            <h2>Complèter votre profil</h2>
                            <div class="checks">
                                <div class="check-item"> <div class="check">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                    </svg>
                                </div> Ajouter une photo de profil </div>
                                <div class="check-item"> <div class="check">
                                    <svg xmlns="http://www.w3.org/2000/svg"  class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                    </svg>
                                </div> Confirmer l'adresse mail</div>
                                <div class="check-item"> <div class="check">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                    </svg>
                                </div> Acheter un cour </div>
                            </div>
                        </div>

                        <div class="congratulations"> 
                            <h4><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960"><path d="m80-80 200-560 360 360L80-80Zm132-132 282-100-182-182-100 282Zm370-246-42-42 224-224q32-32 77-32t77 32l24 24-42 42-24-24q-14-14-35-14t-35 14L582-458ZM422-618l-42-42 24-24q14-14 14-34t-14-34l-26-26 42-42 26 26q32 32 32 76t-32 76l-24 24Zm80 80-42-42 144-144q14-14 14-35t-14-35l-64-64 42-42 64 64q32 32 32 77t-32 77L502-538Zm160 160-42-42 64-64q32-32 77-32t77 32l64 64-42 42-64-64q-14-14-35-14t-35 14l-64 64ZM212-212Z"/></svg>Bravo, vous y êtes presque.</h4>
                            <p>Continuer de compléter les étapes pour avoir un profil parfait</p>
                        </div>
                    </div>

                    <!-- This contain the second block of the complete profil block (Mail confirmation link) -->

                    <div class="block2">
                        <div class="block2-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-mailbox2" viewBox="0 0 16 16">
                                <path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9z"/>
                                <path d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4M8 7a4 4 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8zm-3.415.157C4.42 7.087 4.218 7 4 7s-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157"/>
                            </svg>

                            <div class="send-link">
                                <h4>Un lien de confirmation a été envoyé</h4>
                                <div class="link-mail"><p>Votre addresse mail: iba@gmail.com</p> <a href="">Modifier</a></div>
                            </div>
                        </div>

                        <button>Renvoyez le lien</button>
                    </div>

                </div>
                <!-- Cours template -->
                <div id="cours">
                    <ul>
                        <li class="active">Favoris</li>
                        <li>Cours suivis</li>
                        <li>Derniers cours suivis</li>
                    </ul>

                    <!-- template of a single cour -->

                    <div class="items">

                        <div class="cour">
                            <img src="{{ asset('images/image2.png') }}" alt="img-cour">
                            <div class="text">
                                <h4>nom cour</h4>
                                <div class="meta-info">
                                    <div class="hour">hour</div>
                                    <div class="cour-cate">cour-cate</div>
                                    <div class="publisher"> <img src="" alt=""> publisher</div>
                                </div>
                            </div>
                        </div>

                        <div class="cour">
                            <img src="{{ asset('images/image2.png') }}" alt="img-cour">
                            <div class="text">
                                <h4>nom cour</h4>
                                <div class="meta-info">
                                    <div class="hour">hour</div>
                                    <div class="cour-cate">cour-cate</div>
                                    <div class="publisher"> <img src="" alt=""> publisher</div>
                                </div>
                            </div>
                        </div>

                        <div class="cour">
                            <img src="{{ asset('images/image2.png') }}" alt="img-cour">
                            <div class="text">
                                <h4>nom cour</h4>
                                <div class="meta-info">
                                    <div class="hour">hour</div>
                                    <div class="cour-cate">cour-cate</div>
                                    <div class="publisher"> <img src="" alt=""> publisher</div>
                                </div>
                            </div>
                        </div>

                        <div class="cour">
                            <img src="{{ asset('images/image2.png') }}" alt="img-cour">
                            <div class="text">
                                <h4>nom cour</h4>
                                <div class="meta-info">
                                    <div class="hour">hour</div>
                                    <div class="cour-cate">cour-cate</div>
                                    <div class="publisher"> <img src="" alt=""> publisher</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    
                </div>

                <div id="inputs">
                    <input type="file" id="profile-pic" name="profile-pic">
                    <input type="file" id="cover-pic" name="cover-pic">
                </div>

            </section>

            <div id="overlay">
                    <div id="params">
                        <div class="param-head">
                            <h3>Paramètres</h3> 
                            <button class="btn-close-param">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </button>
                        </div>
                    </div>
            </div>
    </div>


@endsection