<x-guest-layout>
    <style>
        .custom-card {
            background: white;
            padding: 30px;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            max-width: 400px;
            margin: 50px auto;
        }
        .custom-input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 15px;
        }
        .custom-button {
            width: 100%;
            padding: 14px;
            background-color: #db2777; /* Warna PINK */
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
        }
        .custom-button:hover {
            background-color: #be185d;
        }
        .label-text {
            font-size: 10px;
            font-weight: bold;
            color: #94a3b8;
            text-transform: uppercase;
        }
    </style>

    <div class="custom-card">
        <h2 style="text-align: center; font-weight: 900; margin-bottom: 20px;">DAFTAR AKUN</h2>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label class="label-text">NAMA LENGKAP</label>
            <input type="text" name="name" class="custom-input" required>

            <label class="label-text">EMAIL</label>
            <input type="email" name="email" class="custom-input" required>

            <label class="label-text">PASSWORD</label>
            <input type="password" name="password" class="custom-input" required>

            <label class="label-text">KONFIRMASI PASSWORD</label>
            <input type="password" name="password_confirmation" class="custom-input" required>

            <button type="submit" class="custom-button">Daftar Sekarang</button>
        </form>
    </div>
</x-guest-layout>