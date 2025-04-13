<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vue Laravel CRUD</title>
    @vite('resources/js/app.js', 'resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


    <style>
        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            color: #333;

        }

        .welcome-box {
            background: white;
            padding: 40px 60px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
            max-width: 500px;
        }

        .welcome-box h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #4A90E2;
        }

        .welcome-box p {
            font-size: 18px;
        }

        .go-button {
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .go-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    {{-- <script>
        window.authUser = @json(Auth::user());
    </script> --}}


    {{-- <div id="app"> --}}
        {{-- <task-manager></task-manager> --}}
        {{-- <task></task> --}}



    {{-- </div> --}}

    @auth
    <div class="welcome-box">
        <h1>👋 Bienvenue {{ Auth::user()->name }} !</h1>
        <p>Heureux de te revoir dans <strong>TaskApp</strong> ! Prêt(e) à gérer tes tâches comme un(e) pro ? 🚀</p>
        <a href="{{ url('/') }}" class="go-button">
            Accéder à l'application
        </a>
    </div>
@else
    <div class="welcome-box">
        <h1>Bienvenue sur TaskApp 📝</h1>
        <p>Connecte-toi ou crée un compte pour commencer à organiser ta vie ! 💼</p>
    </div>
@endauth


</body>
</html>
