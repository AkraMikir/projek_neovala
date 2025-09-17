<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login Admin</h2>
            
            <form action="{{ url('/admin/login') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan email Anda">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan password Anda">
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html> -->


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .clip-slant {
      clip-path: polygon(0 0, 85% 0, 100% 100%, 0% 100%);
    }
    body {
    font-family: 'Poppins', sans-serif;
  }

  @media (max-width: 768px) {
  .clip-slant {
    clip-path: polygon(0 0, 100% 0, 100% 50%, 0 55%);
  }
}
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[#FFEDCC] relative overflow-hidden">

  <!-- Background miring -->
  <div class="absolute inset-0 flex">
    <div class="w-full md:w-[60%] clip-slant">
      <img src="{{ asset('images/images/home pages/IMG_0362.png') }}" alt="Background Gedung" class="w-full h-full object-cover" />
    </div>
    <div class="hidden md:block w-[40%] bg-[#FFEDCC]"></div>
  </div>

  <!-- Card Login -->
  <div class="relative z-10 w-full max-w-7xl mx-7 md:mx-auto bg-[#FFF6E6] rounded-3xl shadow-md p-3 md:p-3 flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-6 backdrop-blur-sm">

    <!-- Gambar dalam Card -->
    <div class="relative w-full md:w-1/2">
      <img src="{{ asset('images/images/home pages/IMG_0362.png') }}" alt="Gedung" class="rounded-2xl object-cover w-full h-64 md:h-full" />

      <div class="absolute top-3 left-4 text-[#6A4D1F] font-semibold text-sm md:text-lg">Admin Panel</div>
      <button class="absolute top-3 right-4 border-2 border-[#6A4D1F] rounded-full px-3 py-1 text-xs md:text-sm text-white bg-transparent hover:bg-[#f8e9d0] hover:text-[#6A4D1F]">Login Admin</button>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-5 bg-[#FFEDCC] px-3 py-2 rounded-full shadow text-s text-[#6A4D1F] 
    max-w-[90%] overflow-x-auto whitespace-nowrap scrollbar-hide">
    <span><i class="fas fa-money-bill-wave"></i></span>
    <span><i class="fas fa-tags"></i></span>
    <span><i class="far fa-calendar-alt"></i></span>
    <span><i class="fas fa-bed"></i></span>
    <span><i class="fas fa-chair"></i></span>
    <span><i class="fas fa-compass"></i></span>
    <span><i class="fas fa-user-lock"></i></span>
    <span><i class="fa-solid fa-water-ladder"></i></span>
    <span><i class="fa-solid fa-building"></i></span>
    <span><i class="fa-solid fa-mosque"></i></span>
    <span><i class="fa-solid fa-tree"></i></span>
    <span><i class="fa-solid fa-bridge"></i></span>
    <span><i class="fa-solid fa-dumbbell"></i></span>
    <span><i class="fa-solid fa-person-running"></i></span>
      </div>
    </div>

    <!-- Form Login -->
<div class="w-full md:w-1/2">
  <h2 class="text-2xl md:text-3xl font-bold text-[#6A4D1F] mb-2">Balik lagi nih Min?</h2>
  <p class="text-[#6A4D1F] mb-6 text-sm md:text-base">Semangat Admin nambahin sesuatu yang baru !!</p>

  {{-- Penampil error --}}
  @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
      {{ $errors->first() }}
    </div>
  @endif

  <form action="{{ url('/admin/login') }}" method="POST" class="flex flex-col gap-4">
    @csrf
    <label for="email" class="block text-[#6A4D1F] text-sm font-bold mb-1">Email</label>
    <input type="email" name="email" id="email" placeholder="Email" required
      class="rounded-full px-5 py-3 bg-[#FFF3D6] shadow-inner focus:outline-none" />
    
    <div class="relative">
    <label for="password" class="block text-[#6A4D1F] text-sm font-bold mb-4">Password</label>
      <input type="password" name="password" id="password" placeholder="Password" required
        class="rounded-full px-5 py-3 bg-[#FFF3D6] shadow-inner w-full focus:outline-none mb-4" />
      <span id="togglePassword" class="absolute right-4 bottom-3 -translate-y-1/2 text-[#6A4D1F] text-xl cursor-pointer select-none">
        🙈
      </span>
    </div>

    <button type="submit"
      class="rounded-full bg-[#6A4D1F] text-white py-3 text-center font-semibold shadow hover:bg-[#5c3f19] transition">
      go to work ‎ ‎ <span><i class="fa-solid fa-arrow-right -mt-2"></i></span>
    </button>
  </form>
</div>

{{-- Script toggle password --}}
<script>
  const passwordInput = document.getElementById("password");
  const togglePassword = document.getElementById("togglePassword");

  togglePassword.addEventListener("click", () => {
    const isPassword = passwordInput.type === "password";
    passwordInput.type = isPassword ? "text" : "password";
    togglePassword.textContent = isPassword ? "👁" : "🙈";
  });
</script>
</body>
</html>

