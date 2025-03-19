@extends('layouts.default')

@section('content')
<div class="container d-flex flex-column align-items-center justify-content-center vh-100">
    <h2 class="text-center">Welcome, {{ auth()->user()->name }}</h2>

    <label>Select a User to Call:</label>
    <select id="userList" class="form-control w-50 text-center">
        <option disabled selected>Loading users...</option>
    </select>
    <button class="btn btn-primary mt-2" onclick="startCall()">Start Call</button>

    <h3 id="callStatus" class="text-center mt-3">Waiting for calls...</h3>
    <div class="d-flex gap-2 mt-2">
        <button class="btn btn-success" onclick="acceptCall()" id="acceptBtn" style="display: none;">Accept</button>
        <button class="btn btn-danger" onclick="rejectCall()" id="rejectBtn" style="display: none;">Reject</button>
    </div>

    <div class="video-container mt-4">
        <div class="video-wrapper">
            <div class="video-box">
                <video id="localVideo" class="video" autoplay playsinline muted></video>
                <div class="video-label">Admin</div>
            </div>
            <div class="video-box">
                <video id="remoteVideo" class="video" autoplay playsinline></video>
                <div class="video-label">User</div>
            </div>
        </div>
    </div>
</div>

<style>
    .video-container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 800px;
        background: #222;
        padding: 20px;
        border-radius: 10px;
    }

    .video-wrapper {
        display: flex;
        flex-direction: column;
        width: 100%;
        gap: 10px;

    }

    .video-box {
        position: relative;
        width: 100%;
        height: 300px;
        background: black;
        border-radius: 10px;
        border: 2px solid #FFD700;
    }

    .video {
        width: 100%;
        height: 100%;
    }

    .video-label {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/socket.io-client/dist/socket.io.js"></script>
<script>
    let localStream;
    window.onload = function () {
        loadUsers();
        setupRealtimeListeners();
    };
    async function loadUsers() {
        try {
            const response = await fetch('/users');
            const users = await response.json();
            let userList = document.getElementById('userList');
            userList.innerHTML = '<option disabled selected>Select a user</option>';
            users.forEach(user => {
                let option = document.createElement('option');
                option.value = user.id;
                option.textContent = `${user.name}`;
                userList.appendChild(option);
            });
        } catch (error) {
            console.error("Error fetching users:", error);
        }
    }
    async function startCall() {
        let selectedUser = document.getElementById('userList').value;
        if (!selectedUser) {
            alert("Please select a user to call.");
            return;
        }
        try {
            await fetch('/call/initiate', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: JSON.stringify({ receiver_id: selectedUser })
            });
            document.getElementById('callStatus').textContent = "Calling...";
            let localVideo = document.getElementById('localVideo');
            localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            localVideo.srcObject = localStream;
        } catch (error) {
            console.error("Error starting call:", error);
        }
    }
    function setupRealtimeListeners() {
        const userId = {{ auth()->user()->id }};
        Echo.private(`call.${userId}`)
            .listen('SignalEvent', (event) => {
                if (event.type === 'call_request') {
                    document.getElementById('callStatus').textContent = `${event.caller_name} is calling...`;
                    document.getElementById('acceptBtn').style.display = 'inline-block';
                    document.getElementById('rejectBtn').style.display = 'inline-block';
                }
                if (event.type === 'call_accepted') {
                    startLocalVideo();
                }
            });
    }
    async function acceptCall() {
        await fetch('/call/accept', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        });
        document.getElementById('callStatus').textContent = "Connected...";
        startLocalVideo();
    }
    async function rejectCall() {
        await fetch('/call/reject', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        });
        document.getElementById('callStatus').textContent = "Call Rejected";
    }
    async function startLocalVideo() {
        let localVideo = document.getElementById('localVideo');
        localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
        localVideo.srcObject = localStream;
    }
</script>
@endsection