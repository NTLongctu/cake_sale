<?php
    $email = Session::get('Email')
?>
<style>
.chat-container {
    width: 350px;
    border-radius: 6px;
    position: fixed;
    background-color: white;
    bottom: 60px;
    right: 20px;
    z-index: 99;
    box-shadow: 1px 1px 10px gray;
}

.hide {
    display: none !important;
}

.username {
    margin: 0;
}

.chat-toggler {
    padding: 12px;
    border-radius: 50%;
    box-shadow: 1px 1px 4px gray;
    background-color: white;
    position: fixed;
    bottom: 100px;
    right: 20px;
    z-index: 99;
}

.user-avatar {
    width: 54px;
    height: 54px;
    padding: 0 6px;
    object-fit: contain;
}

.user-info {
    gap: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
}

#btn-close-contact,
#btn-close-chat {
    border: none;
    outline: none;
    box-shadow: none;
    background-color: transparent;
}

.chat-header {
    border-bottom: 1px solid gray;
    padding: 0 10px;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    display: flex;
}

#btn-send-chat {
    background-color: transparent;
    border: none;
    outline: none;
    box-shadow: none;
    color: #2b65c2;
}

.sender {
    font-size: 14px;
    width: 90%;
    border: none;
    border-radius: 6px;
    padding: 6px 10px;
    color: gray;
}

.chat-sender {
    border-top: 1px solid gray;
    padding: 6px 10px;
    display: flex;
    justify-content: 'center';
    align-items: center;
}

.icon {
    width: 36px;
    height: 36px;
    object-fit: contain;
}

.chat-body {
    padding: 12px 10px;
    height: 400px;
    overflow-y: scroll;
}

.chat-body::-webkit-scrollbar {
    width: 3px;
}

.chat-body::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.chat-body::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 6px;
}

.chat-body::-webkit-scrollbar-thumb:hover {
    background: #555;
}

.msg-sender {
    font-size: 14px;
    margin-left: auto;
    margin-top: 2px;
    margin-bottom: 2px;
    background-color: #2b65c2;
    color: white;
    border-radius: 16px;
    padding: 2px 6px;
    max-width: 60%;
    text-align: center;
    width: fit-content;
}

.msg-receiver {
    text-align: center;
    min-width: 10%;
    font-size: 14px;
    margin-top: 2px;
    margin-bottom: 2px;
    background-color: #e0e0e0;
    color: black;
    border-radius: 16px;
    padding: 2px 6px;
    max-width: 60%;
    width: fit-content;
}

.list-contact-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 6px 10px;
    border-bottom: 1px solid gray;
}

.contact-header {
    margin: 0;
    font-size: 26px;
}

.contact-item {
    cursor: pointer;
    padding: 12px 10px;
    display: flex;
    gap: 10px;
    justify-content: flex-start;
    align-items: center;
}

.contact-item:hover {
    background-color: #f2f2f2;
    transition: .2s ease;
}

.contact-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
}

.contact-info h6 {
    margin: 0;
}

.contact-info p {
    margin: 0;
}

.contact-avt {
    width: 36px;
    height: 36px;
    object-fit: contain;
}

.contact-info p {
    font-size: 12px;
    color: gray;
}

.contact-body {
    height: 450px;
}
</style>
<div class="chat-toggler" id="toggler">
    <img src="../assets/img/chat.png" class="icon" />
</div>

<div class="chat-container hide" id="container">
    <div class="list-contact-container" id="list-contact">
        <div class="list-contact-header">
            <h5 class="contact-header">Contacts</h5>
            <button id="btn-close-contact">
                <img src="../assets/img/close.png" style="object-fit:contain" width="16" height="16" />
            </button>
        </div>
        <div class="contact-body" id="ct-body">
        </div>
    </div>
    <div class="detail-chat-container hide" id="detail-chat">

    </div>
</div>
<script>
function hello() {
    alert('jee')
}
</script>
<script type="module">
// Import the functions you need from the SDKs you need
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/10.12.5/firebase-app.js";
import {
    getAnalytics
} from "https://www.gstatic.com/firebasejs/10.12.5/firebase-analytics.js";
import {
    getDatabase,
    ref,
    set,
    onValue,
    get,
    child,
    push,
    off,
    onChildAdded,
} from "https://www.gstatic.com/firebasejs/10.12.5/firebase-database.js";

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyCicEqeSZ1vqYK7sfHlk7V2rBzPP672rxU",
    authDomain: "food-app-a8666.firebaseapp.com",
    projectId: "food-app-a8666",
    storageBucket: "food-app-a8666.appspot.com",
    messagingSenderId: "641228464063",
    appId: "1:641228464063:web:38487b67c16bd0ac7f8b0a",
    measurementId: "G-E92LCCPR18",
    databaseURL: 'https://food-app-a8666-default-rtdb.asia-southeast1.firebasedatabase.app/'
};

const id = '<?=$email?>';
// Initialize Firebase
const app = initializeApp(firebaseConfig);
const database = getDatabase(app);
let currentDetailRef = null;
/// process here
const isOpen = false;
const toggler = document.getElementById('toggler');
const container = document.getElementById('container');
const btnCloseContact = document.getElementById('btn-close-contact');

btnCloseContact.addEventListener('click', (e) => {
    container.classList.add('hide');
})
toggler.addEventListener('click', (e) => {
    if (container.classList.contains('hide')) {
        container.classList.remove('hide');
    }
})

export function accessChat(contactName, id) {
    if (contactName) {
        // go chat
        showDetail();
        renderDetail(contactName);
        regDetailEvent(id);
        // get all message
        getAllMessages(id);
        listenAContact(id);
    }
}

function loadAnContactFromId(contactId, adminId) {
    const contactInfo = window.atob(contactId).split('===');
    return contactInfo[0] !== adminId ? contactInfo[0] : contactInfo[1];
}

function listenAContact(roomId) {
    const roomListenQuery = ref(database, "chats/" + roomId);
    currentDetailRef = roomListenQuery;
    onChildAdded(roomListenQuery, (snapshot) => {
        const newMsg = snapshot.val();
        addMessage(newMsg, id)
    });

}

function listenAllContact() {
    // listen all contact
    const contactListenQuery = ref(database, "chats")
    onChildAdded(contactListenQuery, (snapshot) => {
        getAllContact();
    });
}

function getAllContact() {
    const dbRef = ref(database);
    get(child(dbRef, `chats`)).then((snapshot) => {
        if (snapshot.exists()) {
            const data = snapshot.val();
            const mixData = Object.keys(data).map((d) => {
                return {
                    id: d,
                    contact: data[d]
                }
            });
            renderContacts(mixData);
        }
    })
}

function getAllMessages(roomId) {
    const dbRef = ref(database);
    get(child(dbRef, `chats/${roomId}`)).then((snapshot) => {
        if (snapshot.exists()) {
            const data = snapshot.val();
            renderMessages(Object.values(data), id);
        }
    })
}

function renderMessages(messages, sender) {
    document.getElementById('msg-content').innerHTML = "";
    for (let msg of messages) {
        const msgEl = `<div class="${msg?.sender == sender ? 'msg-sender' : 'msg-receiver'}">${msg?.content}</div>`;
        document.getElementById('msg-content').innerHTML += msgEl;
    }
    scrollToBottom()
}

function addMessage(msg, sender) {
    const msgEl = `<div class="${msg?.sender == sender ? 'msg-sender' : 'msg-receiver'}">${msg?.content}</div>`;
    document.getElementById('msg-content').innerHTML += msgEl;
    scrollToBottom()
}

function clearMessage() {
    const msgContent = document.getElementById('txt-content').value = '';
}

function scrollToBottom() {
    const container = document.getElementById('msg-content');
    container.scrollTop = container.scrollHeight;
}


function renderContacts(contacts) {
    document.getElementById('ct-body').innerHTML = "";
    for (let ct of contacts) {
        const msgs = Object.values(ct.contact);
        const contactName = loadAnContactFromId(ct.id, id);
        const lastMessage = msgs[msgs.length - 1];

        const el = document.createElement('div');
        el.setAttribute("class", "contact-item");

        el.innerHTML = `
        <img src="../assets/img/user.png" class="contact-avt" alt="user avatar">
                <div class="contact-info">
                    <h6>${contactName}</h6>
                    <p>${lastMessage.content}</p>
                </div>
        `;
        el.addEventListener('click', () => {
            accessChat(contactName, ct.id);
        })
        document.getElementById('ct-body').appendChild(el);
    }
}

function showDetail() {
    if (currentDetailRef != null) {
        off(currentDetailRef);
    }

    document.getElementById('detail-chat').classList.toggle('hide');
    document.getElementById('list-contact').classList.toggle('hide')
}


function regDetailEvent(roomId) {

    const btnCloseChat = document.getElementById('btn-close-chat');
    const btnSend = document.getElementById('btn-send-chat');

    btnCloseChat.addEventListener('click', (e) => {
        showDetail();
    })
    btnSend.onclick = (e) => {
        const msgContent = document.getElementById('txt-content').value;
        if (msgContent.trim() !== '') {
            const msgRef = ref(database, "chats/" + roomId);
            const newMsg = push(msgRef);
            console.log(roomId);
            set(newMsg, {
                content: msgContent,
                sender: id
            });
            clearMessage();
        }
    };
    document.onkeydown = function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            const msgContent = document.getElementById('txt-content').value;
            if (msgContent.trim() !== '') {
                const msgRef = ref(database, "chats/" + roomId);
                const newMsg = push(msgRef);
                set(newMsg, {
                    content: msgContent,
                    sender: id
                });
                console.log(roomId);
                clearMessage();
            }
        }
    };
}


function renderDetail(contact) {
    document.getElementById('detail-chat').innerHTML = "";
    const el = `
    <div class="chat-header">
            <div class="user-info">
                <img src="../assets/img/user.png" class="user-avatar" alt="user avatar">
                <h6 class="username">${contact}</h6>
            </div>
            <button id="btn-close-chat">
                <img src="../assets/img/close.png" style="object-fit:contain" width="16" height="16" />
            </button>
        </div>
        <div class="chat-body" id="msg-content">

        </div>
        <div class="chat-sender">
            <input type="text" placeholder="Type something" class="sender" id="txt-content">
            <button id="btn-send-chat">Send</button>
        </div>
    `;
    document.getElementById('detail-chat').innerHTML = el;
}

// function renderContact(contact) {
//     const ct = Object.values(contact);
//     const el = `<div onclick="accessChat('${ct[0].sender}')" class="contact-item">
//                 <img src="../assets/img/user.png" class="contact-avt" alt="user avatar">
//                 <div class="contact-info">
//                     <h6>${ct[0].sender}</h6>
//                     <p>${ct[0].content}</p>
//                 </div>
//             </div>`;
//     document.getElementById('ct-body').innerHTML += el;
// }

// load contact first
getAllContact();
listenAllContact();
</script>