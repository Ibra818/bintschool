@extends('index')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <script>

        document.addEventListener('DOMContentLoaded', function(){
            const pauses = document.querySelectorAll('.pause');
            const listes = document.querySelectorAll('#categories ul li');
            const main = document.querySelector('main');
            const navList = document.querySelectorAll('nav ul li');
            const profilePage = document.querySelector('#profile');
            const profileLink = document.querySelector('nav ul li.profile-link');
            const pourToi = document.querySelector('nav ul li.pour-toi');
            const messagerieLink = document.querySelector('nav ul li.messagerie-link');
            const messagerie = document.querySelector('#messagerie');
            const formaSuivieLink = document.querySelector('nav ul li.forma-suivie');
            const formaSuivie = document.querySelector('#formation-suivie');
            const btnParam = document.querySelector('#profile .user .user-profile .btns .param');
            const btnShare = document.querySelector('#profile .user .user-profile .btns .profile-share');
            const btnChangeCover = document.querySelector('#profile .user .user-profile .btns .change-cover');
            const coverPic = document.querySelector('#cover-pic');
            const profilePic = document.querySelector('#profile-pic');
            const overlay = document.querySelector('#overlay');
            const params = document.querySelector('#params');
            const paramHead = document.querySelector('#params .param-head');
            const closeParam = document.querySelector('#params .param-head .par-head-block1 .btn-close-param');
            const infoPerso = document.querySelector('#params .btns .info-perso');
            const courDetailsPage = document.querySelector('#cour-details');
            const courDetailBtnBack = document.querySelector('#cour-details .container-left button');
            const allCours = document.querySelectorAll('#cours .items .cour');
            const coursLi = document.querySelectorAll('#cours ul li');
            const btnDelAcc = document.querySelector('#params .btns .btn-del-acc');
            const btnDevForma = document.querySelector('#params .btns .btn-dev-forma');
            const btnInfoPerso = document.querySelector('#params .btns .btn-info-perso');
            const switchAcc = document.querySelector('#switch-acc');
            const btnCtnSwitchAcc = document.querySelector('#switch-acc .switch-acc-btn-ctn');
            const delAccMsg = document.querySelector('#del-acc-msg');
            const btnConfirmDelAcc = document.querySelector('#del-acc-msg form .btn-del-acc-msg');
            const delReasons = document.querySelector('#params .body .del-reasons');
            const btnDelAccReturn = document.querySelector('.btn-del-acc-return');
            const btnCancelDel = document.querySelector('#params .del-reasons .foot .btn-del-cancel');
            const btnContinuDelAcc = document.querySelector('#params .del-reasons .foot .btn-continue-del-acc');
            const sellCourOverlay = document.querySelector('#cour-details #sell-cour-detail-overlay');
            const btnBuyCour = document.querySelector('#cour-details .cour-detail-body .btn-buy-cour');
            const btnCardPay = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .payment-methods .btns .btn-card-payement');
            const btnMobilePay = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .payment-methods .btns .btn-mobile-money');
            const mobilePayment = document.querySelector('#mobile-payment');
            const pay = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .step1 .btn-pay');
            const btnRetourSellCour = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .btn-retour');
            const sellCourStep1 = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .step1');
            const sellCourStep2 = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .step2');
            const BtnSellStartCour = document.querySelector('#sell-cour-detail-overlay .sell-cour-steps .step2 .btn-start-cour');
            const courList = document.querySelector('#formation-suivie .forma-cour-list');
            const courGrid = document.querySelector('#formation-suivie .forma-cour-grid');
            const courListItem = document.querySelector('#formation-suivie .forma-cour-list .list-item');
            const btnFormaList = document.querySelector('#formation-suivie .btns .btn-table-view');
            const btnFormaGrid = document.querySelector('#formation-suivie .btns .btn-grid-view');
            const cardPay = document.querySelector('#card-payment');
            const mobPay = document.querySelector('#mobile-payment');
            
            // Éléments de la messagerie
            let messagerieInitialized = false;
            let contactItems;
            let messageInput;
            let sendButton;

            btnFormaGrid.addEventListener('click', (e)=>{
                e.preventDefault();
                btnFormaGrid.classList.add('active');
                btnFormaList.classList.remove('active');
                if(courGrid.classList.contains('active')) return;
                if(courList.classList.contains('active')) courList.classList.remove('active');
                courGrid.classList.add('active');
            });


            btnFormaList.addEventListener('click', (e)=>{
                e.preventDefault();
                btnFormaList.classList.add('active');
                btnFormaGrid.classList.remove('active');
                console.log(courGrid.classList.contains('active'));
                if(courList.classList.contains('active')) return;
                if(courGrid.classList.contains('active')) courGrid.classList.remove('active');
                courList.classList.add('active');
            });

            btnRetourSellCour.addEventListener('click', (e)=> {
                e.preventDefault();
                if(sellCourStep2.classList.contains('active')){
                    sellCourStep2.classList.remove('active');
                }else{
                    e.currentTarget.parentNode.parentNode.classList.remove('active');
                }
                
            });


            // Pay a cour 

            pay.addEventListener('click', (e) => {
                e.preventDefault();

                const token = " {{ csrf_token() }} ";
                const data = new FormData(mobilePayment);
                const number = data.get('indicatif') + data.get('mobile-num');
                const code = data.get('code0') + data.get('code1') + data.get('code2') + data.get('code3');

                $.ajax({
                    type: 'POST',
                    url: '/pay-cour',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                    },
                    data: JSON.stringify({
                        number: number,
                        code: code,
                    }),

                    success: function(response){
                        sellCourStep1.classList.remove('active')
                        sellCourStep2.classList.add('active');
                        console.log(response);
                    },

                    error: function(error){
                        console.log('error');
                    }
                });
            });

            
            // 

            btnMobilePay.addEventListener('click', (e) => {
                e.preventDefault();
                e.currentTarget.style.cssText += 'color: orange; border:2px solid orange; transition: color .5s ease;';
                btnCardPay.style.cssText += 'color: white; border:none; transition: all .5s ease-out;';
                console.log('mobile pay clicked');
                if(mobPay.classList.contains('active')){
                    mobPay.classList.remove('active');
                }else{
                    mobPay.classList.add('active');
                }
            });

            btnCardPay.addEventListener('click', (e) =>{
                e.preventDefault();
                e.currentTarget.style.cssText += 'color: orange; border:2px solid orange; transition: color .5s ease;';
                btnMobilePay.style.cssText += 'color: white; border:none; transition: all .5s ease-out;';
                if(cardPay.classList.contains('active')){
                    cardPay.classList.remove('active');
                }else{
                    cardPay.classList.add('active');
                }
            });

            // Buying a cour process

            btnBuyCour.addEventListener('click', (e)=>{
                sellCourOverlay.classList.add('active');
            });

            // Cour detail backward
            courDetailBtnBack.addEventListener('click', (e)=>{
                e.preventDefault();
                courDetailsPage.classList.remove('active');
            });
            // Appear the cour details

            allCours.forEach((cour) => {
                cour.addEventListener('click', (e)=>{
                    e.preventDefault();
                    console.log('clické')
                    courDetailsPage.classList.add('active');
                });
            });
               
            // Request to delete an account

            btnContinuDelAcc.addEventListener('click', (e)=>{
                console.log(delAccMsg);
                params.classList.remove('active');
                delReasons.classList.remove('active');
                overlay.classList.remove('active');
                overlay.classList.add('del-acc');
                delAccMsg.classList.add('active');
                
            });

            
            // Back on the parameters from delete account interface

            btnCancelDel.addEventListener('click', (e)=>{
                e.preventDefault();
                delReasons.classList.remove('active');
                paramHead.classList.remove('active');
            });
             
            btnDelAccReturn.addEventListener('click', (e)=>{
                e.preventDefault();
                delReasons.classList.remove('active');
                paramHead.classList.remove('active');

            });

            // Confirmation of the deletion of the account

                btnConfirmDelAcc.addEventListener('click', (e)=>{
                    e.preventDefault();
                    
                    $.ajax({
                        type: 'DELETE',
                        timeout: 100000,
                        url: 'del-user',
                        success: function(response){

                        },

                        error: function(erreurs){

                        },

                    });
                });
                      
            // Initiate the account deletion process 
                btnDelAcc.addEventListener('click', (e)=>{
                    e.preventDefault();
                    if(!delReasons.classList.contains('active')){
                        
                        delReasons.classList.add('active');
                        paramHead.classList.add('active');

                    }else{
                        return
                    }

                });

            // Action executed when the user want to swicth the type of account

            btnDevForma.addEventListener('click', (e)=>{
                e.preventDefault();
                params.classList.remove('active');
                overlay.classList.remove('active');
                overlay.classList.add('del-acc');
                switchAcc.classList.add('active');
            });
            
            // Show the personnaly information in the parameters
            btnInfoPerso.addEventListener('click', (e)=>{
                e.preventDefault();
                if(infoPerso.classList.contains('active')){
                    infoPerso.classList.remove('active');
                }else{
                    infoPerso.classList.add('active');
                }
            })

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
                if(messagerieLink.classList.contains('active')) messagerieLink.classList.remove('active');
                if(messagerie.classList.contains('active')) messagerie.classList.remove('active');
                if(formaSuivieLink.classList.contains('active')) formaSuivieLink.classList.remove('active');
                if(formaSuivie.classList.contains('active')) formaSuivie.classList.remove('active');
                
                pourToi.classList.add('active');
            });

            // Make the profile page appear

            profileLink.addEventListener('click', (e)=>{
                e.preventDefault();
                if(profilePage.classList.contains('active')) return;
                if(formaSuivieLink.classList.contains('active')) formaSuivieLink.classList.remove('active');
                if(formaSuivie.classList.contains('active')) formaSuivie.classList.remove('active');
                if(messagerieLink.classList.contains('active')) messagerieLink.classList.remove('active');
                if(messagerie.classList.contains('active')) messagerie.classList.remove('active');
                profilePage.classList.add('active');

            });

            // Fonction pour initialiser la messagerie
            function initMessagerieIfNeeded() {
                if (messagerieInitialized) return;
                
                // Récupérer les éléments de la messagerie
                contactItems = document.querySelectorAll('.contact-item');
                messageInput = document.getElementById('message-input');
                sendButton = document.getElementById('send-message');
                
                // Ajouter les écouteurs d'événements
                contactItems.forEach(contact => {
                    contact.addEventListener('click', handleContactClick);
                });
                
                messageInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        sendMessage();
                    }
                });
                
                sendButton.addEventListener('click', sendMessage);
                
                // Marquer comme initialisé
                messagerieInitialized = true;
            }
            
            // Gérer le clic sur un contact
            function handleContactClick(e) {
                // Retirer la classe active de tous les contacts
                contactItems.forEach(c => c.classList.remove('active'));
                
                // Ajouter la classe active au contact cliqué
                this.classList.add('active');
                
                // Mettre à jour les informations du contact dans l'en-tête du chat
                const contactName = this.querySelector('.contact-name').textContent;
                const contactStatus = this.querySelector('.contact-status').textContent;
                const contactImage = this.querySelector('img').src;
                const hasStatusOnline = this.querySelector('.status-online') !== null;
                
                document.getElementById('current-chat-name').textContent = contactName;
                document.getElementById('current-chat-status').textContent = contactStatus;
                document.getElementById('current-chat-avatar').src = contactImage;
                
                const statusOnlineInHeader = document.querySelector('.chat-avatar .status-online');
                if (hasStatusOnline) {
                    if (!statusOnlineInHeader) {
                        const statusSpan = document.createElement('span');
                        statusSpan.className = 'status-online';
                        document.querySelector('.chat-avatar').appendChild(statusSpan);
                    }
                } else {
                    if (statusOnlineInHeader) {
                        statusOnlineInHeader.remove();
                    }
                }
                
                // Simuler le chargement des messages pour ce contact
                loadMessages(this.dataset.contact);
            }
            
            // Fonction pour charger les messages d'un contact
            function loadMessages(contactId) {
                // Dans une application réelle, vous chargeriez les messages depuis une API
                // Pour cette démo, on va juste afficher des messages différents selon le contact
                
                const messagesContainer = document.getElementById('chat-messages');
                
                // Vider les messages existants sauf le premier (qui est l'en-tête "Aujourd'hui")
                const dayHeader = messagesContainer.querySelector('.message-day');
                messagesContainer.innerHTML = '';
                messagesContainer.appendChild(dayHeader);
                
                // Ajouter quelques messages selon le contact
                if (contactId === 'ralph-edwards') {
                    addMessage('received', 'Bonjour, comment ça va aujourd\'hui ?', '10:30');
                    addMessage('sent', 'Bonjour Ralph ! Ça va bien, merci. Et toi ?', '10:31 ✓✓');
                    addMessage('received', 'Très bien ! Je voulais te parler du nouveau projet.', '10:32');
                    addMessage('sent', 'Bien sûr, je suis tout ouïe.', '10:33 ✓✓');
                } else if (contactId === 'courtney-henry') {
                    addMessage('received', 'Salut, as-tu terminé le rapport ?', '09:15');
                    addMessage('sent', 'Pas encore, je le finis aujourd\'hui.', '09:20 ✓✓');
                    addMessage('received', 'Super, merci !', '09:21');
                } else {
                    addMessage('received', 'Bonjour Cedric', '11:00');
                    addMessage('sent', 'Bonjour ! Comment puis-je vous aider ?', '11:01 ✓✓');
                }
                
                // Faire défiler jusqu'au dernier message
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
            
            // Fonction pour ajouter un message à la conversation
            function addMessage(type, content, time) {
                const messagesContainer = document.getElementById('chat-messages');
                
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${type}`;
                
                const contentDiv = document.createElement('div');
                contentDiv.className = 'message-content';
                contentDiv.textContent = content;
                
                const timeDiv = document.createElement('div');
                timeDiv.className = 'message-time';
                timeDiv.textContent = time;
                
                messageDiv.appendChild(contentDiv);
                messageDiv.appendChild(timeDiv);
                
                messagesContainer.appendChild(messageDiv);
            }
            
            // Fonction pour envoyer un message
            function sendMessage() {
                const content = messageInput.value.trim();
                if (content === '') return;
                
                // Ajouter le message à la conversation
                const now = new Date();
                const time = `${now.getHours()}:${String(now.getMinutes()).padStart(2, '0')} ✓✓`;
                addMessage('sent', content, time);
                
                // Vider le champ de saisie
                messageInput.value = '';
                
                // Faire défiler jusqu'au dernier message
                const messagesContainer = document.getElementById('chat-messages');
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
                
                // Simuler une réponse après un court délai
                setTimeout(() => {
                    const responses = [
                        'D\'accord, je comprends.',
                        'Merci pour l\'information.',
                        'Je vais voir ce que je peux faire.',
                        'Parfait, je reviens vers toi rapidement.',
                        'C\'est noté !'
                    ];
                    const randomResponse = responses[Math.floor(Math.random() * responses.length)];
                    const responseTime = `${now.getHours()}:${String(now.getMinutes() + 1).padStart(2, '0')}`;
                    
                    addMessage('received', randomResponse, responseTime);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }, 1500);
            }

            // Show the messagerie page
            messagerieLink.addEventListener('click', (e)=>{
                e.preventDefault();

                if(messagerie.classList.contains('active')) return;
                if(profile.classList.contains('active')) profile.classList.remove('active');
                if(pourToi.classList.contains('active')) pourToi.classList.remove('active');
                if(profilePage.classList.contains('active')) profilePage.classList.remove('active');
                if(formaSuivieLink.classList.contains('active')) formaSuivieLink.classList.remove('active');
                if(formaSuivie.classList.contains('active')) formaSuivie.classList.remove('active');
                messagerie.classList.add('active');
                messagerieLink.classList.add('active');
                
                // Initialiser la messagerie si ce n'est pas déjà fait
                initMessagerieIfNeeded();
            });

            // Show the formation suivie page

            formaSuivieLink.addEventListener('click', (e)=>{
                if(formaSuivie.classList.contains('active')) return;
                if(profile.classList.contains('active')) profile.classList.remove('active');
                if(pourToi.classList.contains('active')) pourToi.classList.remove('active');
                if(profilePage.classList.contains('active')) profilePage.classList.remove('active');
                if(messagerieLink.classList.contains('active')) messagerieLink.classList.remove('active');
                if(messagerie.classList.contains('active')) messagerie.classList.remove('active');
                formaSuivie.classList.add('active');
            });

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
                    if(pause.classList.contains('active')) {
                        pause.classList.add('unactive');
                        video.play();
                    }else{
                        return; 
                    }
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

                <li class="messagerie-link">
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

            <!-- The cour-detail page -->

            <section id="cour-details">
                <div class="cour-detail-body">
                    <div class="container-left">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                            </svg>
                            Retour
                        </button>
                    </div>

                    <div class="container-right">
                        <div class="cdtls-block1">
                            <img src=" {{ asset('images/image2.png') }} " alt="">
                        </div>

                        <div class="cdtls-block2">
                            <!-- The cour introduction (Head) -->
                            <div class="cour-intro">
                                <div class="cour-cat"> Categorie : Business</div>
                                <h3>Créer un compte paypal professionnel depuis l'Afrique(Pays non éligibles) </h3>
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                
                                </div>
                                <div class="cour-reactions">

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

                                <div class="cour-formateur">
                                    <div class="formateur-info">
                                        <img src="{{ asset('images/image4.png') }} " alt="">
                                        <div class="formateur">
                                            <h4>Jean Marc Krebe</h4>
                                            <span>Spécialist Marketing Digital</span>
                                        </div>
                                        <button class="visiter">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                            </svg>
                                            Visiter
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- The cour body -->
                            <div class="cour-body">

                                <div class="a-propos">
                                    <h3>A propos de ce cour</h3>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores tempora animi sit illo! Repellat id, quaerat inventore totam fuga doloremque sed veniam explicabo accusamus mollitia sit rerum dolore ex fugit.</p>
                                    <button class="acces">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                        </svg>
                                        Acces gratuit
                                    </button>

                                    <div class="btns">
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                                                <path d="m826-585-56-56 30-31-128-128-31 30-57-57 30-31q23-23 57-22.5t57 23.5l129 129q23 23 23 56.5T857-615l-31 30ZM346-104q-23 23-56.5 23T233-104L104-233q-23-23-23-56.5t23-56.5l30-30 57 57-31 30 129 129 30-31 57 57-30 30Zm397-336 57-57-303-303-57 57 303 303ZM463-160l57-58-302-302-58 57 303 303Zm-6-234 110-109-64-64-109 110 63 63Zm63 290q-23 23-57 23t-57-23L104-406q-23-23-23-57t23-57l57-57q23-23 56.5-23t56.5 23l63 63 110-110-63-62q-23-23-23-57t23-57l57-57q23-23 56.5-23t56.5 23l303 303q23 23 23 56.5T857-441l-57 57q-23 23-57 23t-57-23l-62-63-110 110 63 63q23 23 23 56.5T577-161l-57 57Z"/>
                                            </svg>
                                            Tous les niveaux
                                        </button>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-people" viewBox="0 0 16 16">
                                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                            </svg>
                                            420 Incrits
                                        </button>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-clock" viewBox="0 0 16 16">
                                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                                            </svg>
                                            4H
                                        </button>
                                    </div>
                                </div>
                                <!-- Chapitre du cour -->
                                <div class="cour-chapters">
                                    <h3>Qu'Allez-vous apprendre</h3>
                                    <div class="chapters-items">
                                        <div class="item">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-1-square" viewBox="0 0 16 16">
                                                    <path d="M9.283 4.002V12H7.971V5.338h-.065L6.072 6.656V5.385l1.899-1.383z"/>
                                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                                </svg>
                                            </button>
                                            Contourner les restrictions paypal
                                        </div>
                                        <div class="item">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-2-square" viewBox="0 0 16 16">
                                                    <path d="M6.646 6.24v.07H5.375v-.064c0-1.213.879-2.402 2.637-2.402 1.582 0 2.613.949 2.613 2.215 0 1.002-.6 1.667-1.287 2.43l-.096.107-1.974 2.22v.077h3.498V12H5.422v-.832l2.97-3.293c.434-.475.903-1.008.903-1.705 0-.744-.557-1.236-1.313-1.236-.843 0-1.336.615-1.336 1.306"/>
                                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                                </svg>
                                            </button>
                                            Contourner les restrictions paypal
                                        </div>
                                        <div class="item">
                                            <button>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-3-square" viewBox="0 0 16 16">
                                                    <path d="M7.918 8.414h-.879V7.342h.838c.78 0 1.348-.522 1.342-1.237 0-.709-.563-1.195-1.348-1.195-.79 0-1.312.498-1.348 1.055H5.275c.036-1.137.95-2.115 2.625-2.121 1.594-.012 2.608.885 2.637 2.062.023 1.137-.885 1.776-1.482 1.875v.07c.703.07 1.71.64 1.734 1.917.024 1.459-1.277 2.396-2.93 2.396-1.705 0-2.707-.967-2.754-2.144H6.33c.059.597.68 1.06 1.541 1.066.973.006 1.6-.563 1.588-1.354-.006-.779-.621-1.318-1.541-1.318"/>
                                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                                                </svg>
                                            </button>
                                            Contourner les restrictions paypal
                                        </div>
                                    </div>
                                </div>
                                <!-- Modules du cours -->
                                <div class="cour-content">
                                    <h3>Contenu du cour</h3>
                                    <div class="part">Partie 1</div>

                                    <div class="content-items">
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                            
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="part">Partie 2</div>

                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div>
                                                <button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-play-fill" viewBox="0 0 16 16">
                                                        <path d="m11.596 8.697-6.363 3.692c-.54.313-1.233-.066-1.233-.697V4.308c0-.63.692-1.01 1.233-.696l6.363 3.692a.802.802 0 0 1 0 1.393"/>
                                                    </svg>
                                                </button> Titre du module
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Public cible -->
                                <div class="public-cible">
                                    <h3>Public cible</h3>
                                    <ul>
                                        <li>Freelanceur et entrepreneurs</li>
                                        <li>Paiement internations</li>
                                    </ul>
                                </div>
                                <!-- Pre requis -->
                                <div class="pre-requis">
                                    <h3>Prérequis</h3>
                                    <ul>
                                        <li>Téléphone et oridination connecté à internet</li>
                                    </ul>
                                </div>
                                <button class="btn-buy-cour">Obtenir ce cours</button>
                            </div>

                        </div>
                    </div>
                </div>

                <div id="sell-cour-detail-overlay">

                    <div class="sell-cour-steps">
                        <button class="btn-retour">Retour</button>
                        <div class="step1 active">
                            <div class="head">
                                <div class="block1">
                                    <img src=" {{ asset('images/image2.png') }}" alt="">
                                </div>
                                
                                <div class="block2">
                                    <h3 class="cour-name">Nom du cour</h3>
                                    <div class="cour-price">
                                        Montant à payer: <div class="price"> 400 000 cfa</div>
                                    </div>
                                    <div class="validite">
                                        <div>Validité : </div>
                                        <button>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                            </svg>
                                            Accès à vie
                                        </button>
                                    </div>
                                </div>

                            </div>

                            <div class="payment-methods">
                                <h4>Choisir votre moyen de paiement: </h4>

                                <div class="btns">
                                    <button class="btn-card-payement">Carte 
                                        <div class="imgs">
                                            <img src="https://static.vecteezy.com/system/resources/previews/019/167/108/original/mastercard-free-download-free-png.png" alt="">
                                            <img src="https://cdn.imgbin.com/23/20/16/imgbin-mastercard-visa-payment-american-express-debit-card-italy-visa-u0xvJCG7cPDWPk4UWVHFAwWC1.jpg" alt="">
                                        </div>
                                    </button>
                                    <button class="btn-mobile-money"> Mobile money
                                        <div class="imgs">
                                            <img src="data:image/png;base64,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" alt="">
                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAABIFBMVEUdyP8BAgL+/v70fyAAAAAAzP/qhT31fhsezP8dyv8ezv8e0P/6giH9hCH3gSD8/Pwas+Qcv/T8ewD09PQbu+4JO0sHMD0Se50Zq9oUhqvLy8sGKjXi4uIINEMbt+oVkLgNWXIqKiq6uroPZICEhITT09MXncjsex8pFgZvb28EHCTs7OwQbYsLS2AFIy0YpdIDFBoXFxecnZ2tra1PT0/edB1HJQqdUhV1PRAUCwO6YRleMQ2CRBHLahs5OTliYmKVlZUdHR1TKwvSbRwxGgcMUWepWRciEwYDDxNDQ0M1NjaHiIhqampSU1MnJydCIwltOQ9OudnYagCFYUSSp6TMkF+1moHqgiuioZPhhjlrtMm7l3Z7r7vaiUe+gFrVjFMvTAXiAAAKrElEQVR4nO2d+VsbNxPHfQxltV5sjLkN2OEyJJwBBzA4TSAkhLZJ0yZN7/f//y/e1a4Na2mkPaDVbB99f9zIPPvJSBppNJotFKysrKysrKysrKysrKysrKysrKysrKysrHAxx3UroVzHMf02jy3G3Mp0a649M9vcay7v7rT23YrLTL/V44m59c02CFqeW2HOfwPScSd3AqZiRMGDmVbhP2BIVpnfFegilE8XWN5HpFtvK/iGjK1cm5E5LQ3fgHG37pp+z8xyCm09Xwh5s5lXRGdlNgEgt+NcxfS7ZpI7H9NDI4hrlRwORg6YiC9AbLPcIbLJm8SAHHEnb2OR1fdSAHLEhXyNRcZmUgFyxP1c+f7KXEpAH/GgnqOh6Ewmn2XuEds5Goqp+2hACJu56aduK4MJfcRmXlwGKzSzAPqIrZwY0clmQp/waU48hpvRhHwk5qKbsvmMgD7ibi6M6K5lJ4SVPBjRfSoRilEa1UPIxVzDpD2FT/LkEHv4WkbMg9d3FiSW9aVaY/VQiLVt+w8Xn4ht93KwdKu0R98a4HmJ69mIwWA9eNg4FBvnYCA6wooN3pdCHUWeQ3HwcFE0In1/waYPBMKjAUwjYkR4NXhYKgqt58gPRCZuK2BxwFJ7GSEcYpeOhdZr5AmdfbHf3RHeYoTvBcIZ8u7ClabSYYeMTjWDicbHFi0O9Al3RMLDWgizHp1poBE+fC65lgL1qcZtS17824BlddRbHNfCqVRqPU+ckBVm5aXY7dHG4rbYHT/4D9flxRz5dRsrKFagyBoUX60uEJ9MWT3j7veOkLq7kJxFasIZ4ltEad0tEcTYGG6IE7q6UHAkT0HThvjuonKtO9K+vOh3u93+xQs1I1B3FxXFgYyPtHXSrXpVLq/aPTlTpi8Q311UsPf2Yc4uria8anmoqjfRP8UhibsL2VkEg+6815m4xxtATnR658iYJOEumONWXHTp4TsLYeny5vyi1/FEvFCe1+ldnG8JvyAQUXQKrbXrnXksD8ZpiRZ5UZ6o4nyBIX1LioTLxsdhZf8g6FzXddmMsrOAra6nBPTN2C+K/ycH04YRK4NTCYDlFQkRcRZw1p9QAk68Rdark2YJfSsN3wkO5sVJobKMrbtPpGlmYMDyKbb2Nnvc7W/hIzt1ELKZGMPcoe/pu8hcU/X67+i5C2GuBP9tol2Krajc+InoLjzv6kdFY5OJJ6wuJMnwPJgIoqPKEgpcvuf7/GowgXqhL0Sbmo3sV6RjJX9KjRxNs03dqnTr9G2/26l2ur2Tc9WijbdcNheqwUzkT6n3XiPpzkK7hTK5u3CkKFPwRnuTw24lh6EyyCAhm1bNI/uDhZa7+wiEBt2FFOy9R2wFiKye9QR/9M8tGCNU5gEBzPEpVWXktITGTmccXUr6mj+lSqcyGQmvDRFqcywAdguOxlmkItwztH+SdkYCYnM6Q0Yi/qdIEvI44KR4KpMV0ZC7iA+F3khnFhkJDbmLWMLio8wzRXOnM3G99PFkyl08+EgiOeG1mamG1f81wllDk2nl4F9ChKeGlt4PSDpMSWgqM0oK9/5zhIbcReb87ei7x2x/B81Mnc6MBNqy4X24fckzMeOOSU3tLh5kRIDD7cWlIMFt4/n7mJulxoJRzmZWI/pWO2qU7rV4rA3V7BoLt8nBtqSA21E+OYNIaN40F6oRs0eTAq6WJDXeazbU5k5nWD3D/gGKSzKgr211VMTg6Ywzne7qZPC+OKAO0eRhvlOXbxvoARUW5PpWFb0zmirspIsZwl0KLaKamKw//JHZw3w2nQbxPqUb05IiyLxrNkMxTUe9S9VX6Agn3DOcSOskvqmtnmW0Q9F8qrCTtKPq+6i6n5q/WcKSOQ14LS5lZK2jhOZzv5KNxftbB2o18MN888nQScbi3eUfrV5hhBSqSCRwGoNLXTF6hqWcEMj94ogxHfXuVkWMkMUbHFAg9DuqPvp2dzMmRhtYeoD5ccilX4YDbCQjLL1ECA3nfg3FVjSIcFtLSCjPNXRKSEjXDaNv+V1CQMzr07k7o/aLyTtpqfRaJqTgLkIpZ1Q4TDaTcsnrGhruIpSrCIUP7qwlkngdmOd+0SHkBYXQpWWCFdtQ4kVLfjpD6WYJXuojxTAslW4lQiruIpCDZZkApACUByLAPJXJtMBTg7Hk5ydpCOWtPh13wYVlvMF2GsINyu6igGc/J9tXDCXvL6BNaDLFbv8WsUC+Wg3J58MMoZkGv2eRZiqVaitQcxfYEX/CveFQUsjN5OkMIuQ2UEpCeRdM66olQniYdOsUClmZ0nIXMuGTdITIFpFUIRd5HMLLdIRigQzjpzOCKlKSftx5RQLCGUqEcrFLOE5HiCzbgBAhk4Nuj0Fo+nQmImTV9vBeSspdYISJA21qQkLuAkmufbi3IHUzH0kBh+JDPT4pdyEVh3qMVRupQi7YrTx4looQOewmcjoTCI1ipNo91ZAUMEKFXPDiUCmCiXKJyJCQjLvACR8YxaB0OsPdofR6Rfg+DaEc9OZ/ggwhetcEXqchRBw+JZeP3jsESOMQ0SxFCgkZofAbUbqMPUny8VqR0qJGQZhiqmngp1fUCX9ITrhKnRC9/5vmhBRPFiY0DtF7e9rUWUGIvy+Smksn8RdMmE6DJtQEf8B8+t5AioKX8CFpN/0OB6Tj8dFVWzG5v1BkexNal6J7i2LyI0S51u6AkMzeQnX3EhLuERV3EqBJZ3+oqryTLCtKka9PKoohf/FhaMQka1M0DbpIyVnwyVSVFxWbyI5vDcMfU8o3kc8tBi9ZjB+J36sAb+h0Uk0JrHivr/D25JIx1IXa4gJSyluIxD6mhxVMDN8zZquPJeqHP6SVqaCukhXTT5V9lFgn1dViB11YsSFWL438jNJMyiV+QCf6rsrlKRYHHv6KUAZtKE2dLyViTUoTivyG1jzD5ehqlaOIDTVgEZZpjUIuXV0QwKJSS2h8ja4JdSORv/GxcNOy9kpbVMFUUTqt9DUF+bfJIh306IO+MbWJNJS+IB0A/PB8Y6lRe7a0ui1/U260Kal0qHvd10nG67AGTw4PsUrzo81hmeonV8PPAPNXPXvz4vLFx3c4pIx39uaj33xr8G/E8i5HxEv0AFyeXHUmuDpXb89ji+3Am4t+1+PNy93ej7y+MJ1QNyL3Gk6vqnfFu6ue173QTymX/bI3LLzPq+yfkFuQjmrs009C3e6q11XWtS7CWU9qPv4z1UHIxT5PIbXXkeL5AwOed5CvCkx9oTsM2S9T+PcB+nhM/AL/7sXUV6qIY3/ggPwbD1giwqnqmwnjRBHHflUB+lbsyal95+qPQoz/5hBEZL+rAX3EC9ELbnXUny4pT/0xZppHFvttXENYLr8bQQTo6T5dUp76nZwRxz7rTOgPxd4o4aW6j3KNf6VnxHG9CcveyBdzoK/po4ER/yRmRPan3oQ+4UmEEN7pTegb8QsxI459iTFhudqNfr/lRDsKefPxT7SM6HTiCMvlj5C8k5LrpuxTXCf1HcbpHSFAJ7b51C+kumn8MBwZiPAxtrU/EGnZ8PPUeJz4umaocy+2+fhfxAi/fhOrv9u7y83mXnN2pr0d3/qb/5EiLLCxBHIrQyVpTWoYWllZWVlZWVlZWVlZWVlZWVlZWVlZWVn9g/o/UFz1PAKkfksAAAAASUVORK5CYII=" alt="">
                                        </div>
                                    </button>
                                </div>

                                <div class="forms">

                                    <form action="" id="card-payment">

                                        <div class="ctn-card-name">
                                            <label for="">Nom de titulaire</label>
                                            <input type="text" id="card-name" name="card-name">
                                        </div>
                                        <div class="ctn-card-number">
                                            <label for="card-number">Numero de la carte</label>
                                            <input type="text" id="card-number" name="card-number">
                                        </div>

                                        <div class="card-payment-foot">

                                            <div class="expiration">
                                                Expiration
                                                <div class="card-year-month">
                                                    <input type="number" min="0" max="1" step="1" name="month0" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)">
                                                    <input type="number" min="0" max="1" step="1" name="month1" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)">
                                                    /
                                                    <input type="number" min="0" max="1" step="1" name="year0" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)">
                                                    <input type="number" min="0" max="1" step="1" name="year1" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)">
                                                </div>
                                            </div>

                                            <div class="cvc">
                                                CVC
                                                <div class="inputs">
                                                    <input type="number" min="0" max="1" step="1" name="cvc0" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)">
                                                    <input type="number" min="0" max="1" step="1" name="cvc1" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)">
                                                    <input type="number" min="0" max="1" step="1" name="cvc2" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)">
                                                </div>
                                            </div>

                                        </div>

                                        

                                    </form>

                                    <form action="" id="mobile-payment">

                                        <div class="number">

                                            <select id="indicatif" name="indicatif">
                                                <option value="">Votre pays</option>
                                                <option value="+223">Mali</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Niger">Niger</option>
                                            </select>

                                            <div class="ctn-mobile-num">
                                                <input type="text" id="mobile-num" name="mobile-num">
                                            </div>
                                        </div>

                                        <div class="code-confirmation">
                                            <h4>Code de confirmation</h4>
                                            <p>Compose le code **** pour générer un code de validation</p>

                                            <div class="inputs">
                                                <input type="number" max="9" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)" name="code0">
                                                <input type="number" max="9" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)" name="code1">
                                                <input type="number" max="9" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)" name="code2">
                                                <input type="number" max="9" min="0" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1)" name="code3">
                                            </div>
                                        </div>
                                    </form>

                                </div>

                                
                            </div>

                            <button class="btn-pay">Payer</button>
                        </div>

                        <div class="step2">
                            <div class="head">
                                <img src="{{ asset('images/image2.png') }}" alt="">
                                <div class="step2-head-ctn">
                                    Comprendre les bitcoins et les criptos
                                    <div class="cour-info">
                                        <div class="block1">
                                            <div class="hour">4h</div> 
                                            <div class="cour-cat">Design</div>
                                        </div>
                                        <div class="user"> <img src="{{ asset('images/image4.png')}}" alt="">Isaac Mars</div>
                                    </div>
                                    <div class="acces">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
                                        </svg>
                                        Acces à vie gratuitement</div>
                                </div>   
                            </div>
                            <button class="btn-start-cour">Commencer</button>
                        </div>

                    </div>
               
                </div>

            </section>

            <!-- Messagerie Page -->

            <section id="messagerie">

                <!-- Panneau gauche - Liste des contacts -->

                <div class="messagerie-sidebar">
                    
                    <div class="messagerie-header">
                        <h2>Messagerie</h2>
                        <div class="search-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            <input type="text" placeholder="Rechercher" id="search-contacts">
                        </div>
                    </div>

                    <div class="contacts-section">
                        <h3>Contacts</h3>
                        <div class="online-contacts">
                            <div class="contact-item active" data-contact="ralph-edwards">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=50&h=50&fit=crop&crop=face" alt="Ralph Edwards">
                                    <span class="status-online"></span>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Ralph Edwards</div>
                                    <div class="contact-status">En ligne depuis 3h</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="courtney-henry">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1494790108755-2616b668e7b0?w=50&h=50&fit=crop&crop=face" alt="Courtney Henry">
                                    <span class="status-online"></span>
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Courtney Henry</div>
                                    <div class="contact-status">Activité</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="ronald-richards">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=50&h=50&fit=crop&crop=face" alt="Ronald Richards">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Ronald Richards</div>
                                    <div class="contact-status">Bonjour Cedric</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="devon-lane">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=50&h=50&fit=crop&crop=face" alt="Devon Lane">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Devon Lane</div>
                                    <div class="contact-status">Bonjour Cedric</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="darlene-robertson">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=50&h=50&fit=crop&crop=face" alt="Darlene Robertson">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Darlene Robertson</div>
                                    <div class="contact-status">Bonjour Cedric</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="cody-fisher">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=50&h=50&fit=crop&crop=face" alt="Cody Fisher">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Cody Fisher</div>
                                    <div class="contact-status">Bonjour Cedric</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="conversations-section">
                        <h3>Conversations</h3>
                        <div class="conversation-list">
                            <div class="contact-item" data-contact="courtney-henry">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1494790108755-2616b668e7b0?w=50&h=50&fit=crop&crop=face" alt="Courtney Henry">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Courtney Henry</div>
                                    <div class="contact-status">4:52</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="ronald-richards">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=50&h=50&fit=crop&crop=face" alt="Ronald Richards">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Ronald Richards</div>
                                    <div class="contact-status">9:12</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="ralph-edwards">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=50&h=50&fit=crop&crop=face" alt="Ralph Edwards">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Ralph Edwards</div>
                                    <div class="contact-status">7:30</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="devon-lane">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=50&h=50&fit=crop&crop=face" alt="Devon Lane">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Devon Lane</div>
                                    <div class="contact-status">2:06</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="darlene-robertson">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=50&h=50&fit=crop&crop=face" alt="Darlene Robertson">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Darlene Robertson</div>
                                    <div class="contact-status">2:06</div>
                                </div>
                            </div>

                            <div class="contact-item" data-contact="cody-fisher">
                                <div class="contact-avatar">
                                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=50&h=50&fit=crop&crop=face" alt="Cody Fisher">
                                </div>
                                <div class="contact-info">
                                    <div class="contact-name">Cody Fisher</div>
                                    <div class="contact-status">2:06</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panneau droit - Zone de conversation -->
                <div class="messagerie-chat">
                    <div class="chat-header">
                        <div class="chat-contact-info">
                            <div class="chat-avatar">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face" alt="Ralph Edwards" id="current-chat-avatar">
                                <span class="status-online"></span>
                            </div>
                            <div class="chat-contact-details">
                                <div class="chat-contact-name" id="current-chat-name">Ralph Edwards</div>
                                <div class="chat-contact-status" id="current-chat-status">En ligne depuis 3h</div>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <button class="chat-action-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="chat-messages" id="chat-messages">
                        <div class="message-day">Aujourd'hui</div>
                        
                        <div class="message received">
                            <div class="message-content">Bonjour, ça va et toi ?</div>
                            <div class="message-time">11:00</div>
                        </div>

                        <div class="message sent">
                            <div class="message-content">Bonjour Henry, comment vas-tu ?</div>
                            <div class="message-time">11:00 ✓✓</div>
                        </div>

                        <div class="message received">
                            <div class="message-content">Bonjour, ça va et toi ?</div>
                            <div class="message-time">11:00</div>
                        </div>

                        <div class="message sent">
                            <div class="message-content">Bonjour Henry, comment vas-tu ?</div>
                            <div class="message-time">11:00 ✓✓</div>
                        </div>
                    </div>

                    <div class="chat-input-container">
                        <div class="input-wrapper">
                            <input type="text" placeholder="Tapez votre message..." id="message-input">
                            <button class="send-btn" id="send-message">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section id="formation-suivie">

                <div class="forma-head">
                    <h4>Vos formations</h4>

                    <div class="ctn-right">
                        <form action="">
                            <div class="ctn-forma-search">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                                <input type="text" name="forma-search" placeholder="Rechercher">
                            </div>
                            <button class="btn-forma-search">Rechercher</button>
                        </form>

                    </div>

                </div>

                <div class="btns">
                    Les cours que vous suivez sont ici

                    <div class="btns-btns">
                        <button class="btn-table-view">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-list-ul" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                            </svg>
                        </button>

                        <button class="btn-grid-view">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-grid" viewBox="0 0 16 16">
                                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                            </svg>
                        </button>
                    </div>
                            
                </div>

                <!-- Table display -->

                <div class="forma-cour-list">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-sort-alpha-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.082 5.629 9.664 7H8.598l1.789-5.332h1.234L13.402 7h-1.12l-.419-1.371zm1.57-.785L11 2.687h-.047l-.652 2.157z"/>
                                        <path d="M12.96 14H9.028v-.691l2.579-3.72v-.054H9.098v-.867h3.785v.691l-2.567 3.72v.054h2.645zm-8.46-.5a.5.5 0 0 1-1 0V3.707L2.354 4.854a.5.5 0 1 1-.708-.708l2-1.999.007-.007a.5.5 0 0 1 .7.006l2 2a.5.5 0 1 1-.707.708L4.5 3.707z"/>
                                    </svg>
                                    Titre
                                </th>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-hourglass-top" viewBox="0 0 16 16">
                                        <path d="M2 14.5a.5.5 0 0 0 .5.5h11a.5.5 0 1 0 0-1h-1v-1a4.5 4.5 0 0 0-2.557-4.06c-.29-.139-.443-.377-.443-.59v-.7c0-.213.154-.451.443-.59A4.5 4.5 0 0 0 12.5 3V2h1a.5.5 0 0 0 0-1h-11a.5.5 0 0 0 0 1h1v1a4.5 4.5 0 0 0 2.557 4.06c.29.139.443.377.443.59v.7c0 .213-.154.451-.443.59A4.5 4.5 0 0 0 3.5 13v1h-1a.5.5 0 0 0-.5.5m2.5-.5v-1a3.5 3.5 0 0 1 1.989-3.158c.533-.256 1.011-.79 1.011-1.491v-.702s.18.101.5.101.5-.1.5-.1v.7c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13v1z"/>
                                    </svg>
                                    Durée
                                </th>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-calendar-week" viewBox="0 0 16 16">
                                        <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                                    </svg>
                                    Date début
                                </th>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-ui-radios-grid" viewBox="0 0 16 16">
                                        <path d="M3.5 15a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m9-9a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5m0 9a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5M16 3.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-9 9a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m5.5 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-9-11a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m0 2a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                    Categorie
                                </th>
                                <th>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-person" viewBox="0 0 16 16">
                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                    </svg>
                                    Nom formateur
                                </th>
                            </tr>

                        </thead>

                        <tbody>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                            <tr> 
                                <td>Nom cours</td>
                                <td>4h</td>
                                <td>Date Début</td>
                                <td>Catégorie</td>
                                <td>Nom formateur</td>
                            </tr>
                        </tbody>

                        <tfoot></tfoot>
                    </table>
                </div>

                <!-- Grid display -->

                <div class="forma-cour-grid active">

                    <div class="list-item">
                        <div class="list-item-head">
                            <video muted poster=" {{ asset('images/image2.png') }}" preload="auto">
                                <source src="" type=""> </source>
                            </video>
                        </div>
                        <div class="text">
                            <div class="type">Bussiness</div>
                            <div class="name">Cour name</div>
                            <div class="jauge"> 
                                <div class="jauge-jauge"></div> 
                                10% <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                </svg>
                            </div>
                            <div class="duree-user">
                                <div class="duree">4h</div>
                                <div class="user"><img src="{{ asset('images/image4.png') }}" alt=""> Username</div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="list-item-head">
                            <video muted poster=" {{ asset('images/image2.png') }}" preload="auto">
                                <source src="" type=""> </source>
                            </video>
                        </div>
                        <div class="text">
                            <div class="type">Bussiness</div>
                            <div class="name">Cour name</div>
                            <div class="jauge"> 
                                <div class="jauge-jauge"></div> 
                                10% <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                </svg>
                            </div>
                            <div class="duree-user">
                                <div class="duree">4h</div>
                                <div class="user"><img src="{{ asset('images/image4.png') }}" alt=""> Username</div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="list-item-head">
                            <video muted poster=" {{ asset('images/image2.png') }}" preload="auto">
                                <source src="" type=""> </source>
                            </video>
                        </div>
                        <div class="text">
                            <div class="type">Bussiness</div>
                            <div class="name">Cour name</div>
                            <div class="jauge"> 
                                <div class="jauge-jauge"></div> 
                                10% <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                </svg>
                            </div>
                            <div class="duree-user">
                                <div class="duree">4h</div>
                                <div class="user"><img src="{{ asset('images/image4.png') }}" alt=""> Username</div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="list-item-head">
                            <video muted poster=" {{ asset('images/image2.png') }}" preload="auto">
                                <source src="" type=""> </source>
                            </video>
                        </div>
                        <div class="text">
                            <div class="type">Bussiness</div>
                            <div class="name">Cour name</div>
                            <div class="jauge"> 
                                <div class="jauge-jauge"></div> 
                                10% <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                </svg>
                            </div>
                            <div class="duree-user">
                                <div class="duree">4h</div>
                                <div class="user"><img src="{{ asset('images/image4.png') }}" alt=""> Username</div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="list-item-head">
                            <video muted poster=" {{ asset('images/image2.png') }}" preload="auto">
                                <source src="" type=""> </source>
                            </video>
                        </div>
                        <div class="text">
                            <div class="type">Bussiness</div>
                            <div class="name">Cour name</div>
                            <div class="jauge"> 
                                <div class="jauge-jauge"></div> 
                                10% <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                </svg>
                            </div>
                            <div class="duree-user">
                                <div class="duree">4h</div>
                                <div class="user"><img src="{{ asset('images/image4.png') }}" alt=""> Username</div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="list-item-head">
                            <video muted poster=" {{ asset('images/image2.png') }}" preload="auto">
                                <source src="" type=""> </source>
                            </video>
                        </div>
                        <div class="text">
                            <div class="type">Bussiness</div>
                            <div class="name">Cour name</div>
                            <div class="jauge"> 
                                <div class="jauge-jauge"></div> 
                                10% <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                </svg>
                            </div>
                            <div class="duree-user">
                                <div class="duree">4h</div>
                                <div class="user"><img src="{{ asset('images/image4.png') }}" alt=""> Username</div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="list-item-head">
                            <video muted poster=" {{ asset('images/image2.png') }}" preload="auto">
                                <source src="" type=""> </source>
                            </video>
                        </div>
                        <div class="text">
                            <div class="type">Bussiness</div>
                            <div class="name">Cour name</div>
                            <div class="jauge"> 
                                <div class="jauge-jauge"></div> 
                                10% <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                </svg>
                            </div>
                            <div class="duree-user">
                                <div class="duree">4h</div>
                                <div class="user"><img src="{{ asset('images/image4.png') }}" alt=""> Username</div>
                            </div>
                        </div>
                    </div>

                    <div class="list-item">
                        <div class="list-item-head">
                            <video muted poster=" {{ asset('images/image2.png') }}" preload="auto">
                                <source src="" type=""> </source>
                            </video>
                        </div>
                        <div class="text">
                            <div class="type">Bussiness</div>
                            <div class="name">Cour name</div>
                            <div class="jauge"> 
                                <div class="jauge-jauge"></div> 
                                10% <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-trophy" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5q0 .807-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33 33 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935m10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935M3.504 1q.01.775.056 1.469c.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.5.5 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667q.045-.694.056-1.469z"/>
                                </svg>
                            </div>
                            <div class="duree-user">
                                <div class="duree">4h</div>
                                <div class="user"><img src="{{ asset('images/image4.png') }}" alt=""> Username</div>
                            </div>
                        </div>
                    </div>

                </div>

            </section>


            <!-- container the settings element -->

            <section id="overlay">
                <div id="params">

                    <div class="param-head">
                        <div class="par-head-block1">
                            <h3>Paramètres</h3> 
                                <button class="btn-close-param">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </button>
                        </div>

                        <div class="par-head-block2">
                            <button class="btn-del-acc-return">
                                <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                                </svg>
                                <h2>Supprimer le compte</h2>
                            </button>
                        </div>
                        
                    </div>

                    <div class="body">
                        <div class="btns">

                            <div class="info-perso">
                                <button class="btn-info-perso">Informations personnelles 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>

                                <form action="" method="POST">

                                    <div class="ctn-input ctn-username">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                        </svg>
                                        <input type="text" id="username" name="username" placeholder="Username" required>
                                    </div>

                                    <div class="ctn-input ctn-email">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-envelope" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                        </svg>
                                        <input type="email" id="email" name="email" placeholder="Email" required>
                                    </div>

                                    <div class="ctn-input ctn-password">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-lock" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
                                        </svg>
                                        <input type="password" id="password" name="passowrd" placeholder="Mot de passe" required>
                                    </div>

                                    <button type="submit">Envoyer</button>
                                        
                                </form>

                            </div>
                                
                            <div class="ctn-dev-forma">
                                <button class="btn-dev-forma">Devenir formateur
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>
                            </div>

                            <div class="ctn-del-acc">
                                <button class="btn-del-acc">Supprimer le compte
                                    <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                    </svg>
                                </button>
                            </div>

                        </div>

                        <div class="del-reasons">
                            <h3>Oh! Pourquoi partir maintenant?</h3>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorem deleniti tempore dolores reiciendis repellendus odio dolor vel ab reprehenderit doloremque incidunt quaerat pariatur magni eaque esse illo, impedit provident! Error.</p>
                            <form action="">
                                <label for="reasons">Les raisons de votre départ</label>
                                <textarea name="reasons" id="reasons"></textarea>
                            </form>
                            <div class="foot">
                                <button class="btn-del-cancel">Annuler</button>
                                <button class="btn-continue-del-acc">Continuer</button>
                            </div>
                        </div>

                    </div>


                </div>

                <!-- To delete the account  -->

                <div id="del-acc-msg">

                    <div class="del-acc-head">
                        <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                        </svg>
                        <h3>Cette action est irréverssible. </h3>
                        <p>Cette action va supprimer votre compte, Confirmer avec votre mot de passe </p>
                    </div>
                    <form>
                        <label for="del-password">Mot de passe</label>
                        <input type="passowrd" id="del-password" name="del-password" required>
                        <button type="submit" class="btn-del-acc-msg">Supprimer le compte</button>
                    </form>

                </div>

                <!-- TO switch account  -->

                <div id="switch-acc">
                    <div class="switch-acc-head">
                        <h3>Vous rêvez de partager votre savoir</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime libero harum tenetur asperiores!</p>
                    </div>
                    <div class="switch-acc-advantages">
                        <h4>Avantages</h4>
                        <div class="advantage-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                            Publiez des cours
                        </div>
                        <div class="advantage-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                            Vendre des cours
                        </div>
                        <div class="advantage-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg> 
                            Effectuez des retrais d'argent
                        </div>
                        <div class="advantage-item">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-check-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                            </svg>
                            Être connu comme expert du domaine
                        </div>
                    </div>
                    <button class="switch-acc-btn-ctn">Continuer</button>
                </div>

            </section>
    </div>


@endsection