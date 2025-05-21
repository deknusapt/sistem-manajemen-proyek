<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-10">
        <div class="bg-white p-8 rounded-lg shadow-md max-w-xl mx-auto">
            <h2 class="text-2xl font-bold mb-6">Tambah Pengguna Baru</h2>

            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" id="fullname" name="fullname" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" id="email" name="email" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>

                <div>
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" id="password" name="password" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                </div>

                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                    <select id="role" name="role" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        <option value="">-- Pilih Role --</option>
                        <option value="engineer">Engineer</option>
                        <option value="project_manager">Project Manager</option>
                    </select>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('users.index') }}"
                       class="text-gray-700 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Batal
                    </a>

                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
</body>
</html>
