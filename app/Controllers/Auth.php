<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\MemberModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login', ['title' => 'Login Arisan Kuyy']);
    }

    public function register()
    {
        return view('auth/register', ['title' => 'Daftar Akun']);
    }

    public function saveRegister()
    {
        $userModel = new UserModel();
        $memberModel = new MemberModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $memberName = $this->request->getPost('member_name');
        $groupId = $this->request->getPost('group_id');

        // Cegah duplikasi username
        if ($userModel->where('username', $username)->first()) {
            session()->setFlashdata('error', 'Username sudah digunakan.');
            return redirect()->back();
        }

        // 1️⃣ Simpan ke tabel members
        $memberData = [
            'group_id' => $groupId,
            'member_name' => $memberName,
            'has_paid' => 0
        ];

        $memberModel->insert($memberData);
        $memberId = $memberModel->getInsertID();

        // 2️⃣ Simpan ke tabel users, mengacu ke member_id
        $userData = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'member',
            'member_id' => $memberId
        ];

        $userModel->insert($userData);

        // 3️⃣ Login otomatis setelah daftar
        session()->set([
            'user_id' => $userModel->getInsertID(),
            'username' => $username,
            'member_id' => $memberId,
            'member_name' => $memberName,
            'role' => 'member',
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    public function attemptLogin()
    {
        $userModel = new UserModel();
        $memberModel = new MemberModel();

        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $memberName = 'Pengguna';
            if (!empty($user['member_id'])) {
                $member = $memberModel->find($user['member_id']);
                if ($member) {
                    $memberName = $member['member_name'];
                }
            }

            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'member_id' => $user['member_id'],
                'member_name' => $memberName,
                'role' => $user['role'],
                'logged_in' => true
            ]);

            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
