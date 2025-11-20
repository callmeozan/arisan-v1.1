<?php

namespace App\Controllers;

use App\Models\UserModel;

class Register extends BaseController
{
    public function index()
    {
        // Kalau sudah login, langsung ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register', ['title' => 'Daftar Akun Arisan Kuyy']);
    }

    public function attemptRegister()
    {
        $model = new UserModel();

        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));
        $role = $this->request->getPost('role') ?? 'member';

        // Validasi sederhana
        if (empty($username) || empty($password)) {
            session()->setFlashdata('error', 'Username dan password wajib diisi.');
            return redirect()->back();
        }

        // Cek apakah username sudah digunakan
        if ($model->where('username', $username)->first()) {
            session()->setFlashdata('error', 'Username sudah digunakan, silakan pilih yang lain.');
            return redirect()->back();
        }

        // Simpan user baru ke database
        $userId = $model->insert([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $role,
        ]);

        // Otomatis login setelah berhasil register
        session()->set([
            'user_id' => $userId,
            'username' => $username,
            'role' => $role,
            'logged_in' => true
        ]);

        // Arahkan langsung ke dashboard
        return redirect()->to('/dashboard');
    }
}
