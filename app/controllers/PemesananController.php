<?php

require_once '../app/models/Pemesanan.php';
require_once '../app/models/User.php';
require_once '../app/models/Vaksin.php';
require_once '../app/models/EWallet.php';

class PemesananController extends Controller
{

  public function index()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $vaksin = Vaksin::find($id);
      $ewallets = EWallet::all();

      if ($vaksin) {
        $this->view('pemesanan/index', ['vaksin' => $vaksin, 'ewallets' => $ewallets]);
      } else {
        header('Location: ' . BASE_URL . 'vaksin');
        exit;
      }
    } else {
      header('Location: ' . BASE_URL . 'vaksin');
      exit;
    }
  }


  public function success()
  {
    $this->view('pemesanan/success');
  }

  public function store()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $errors = [];

      // Validasi input
      if (empty($_POST['user_id'])) $errors[] = 'User is required';
      if (empty($_POST['vaksin_id'])) $errors[] = 'Vaksin is required';
      if (empty($_POST['time'])) $errors[] = 'Schedule is required';
      if (empty($_POST['location'])) $errors[] = 'Location is required';
      if (empty($_POST['ewallet'])) $errors[] = 'E-Wallet is required';

      if (!empty($errors)) {
        $ewallets = EWallet::all();
        $this->view('pemesanan/index', [
          'errors' => $errors,
          'vaksin' => Vaksin::find($_POST['vaksin_id']),
          'ewallets' => $ewallets
        ]);
        return;
      }

      // Set nilai default untuk IsConfirm jika tidak ada input
      $isConfirm = false;  // Atau Anda bisa set sebagai 0, tergantung format di database Anda

      // Simpan data pemesanan
      $pemesanan = new Pemesanan();
      $pemesanan->UserID = $_POST['user_id'];
      $pemesanan->VaksinID = $_POST['vaksin_id'];
      $pemesanan->Schedule = $_POST['time'];
      $pemesanan->Location = $_POST['location'];
      $pemesanan->EWalletID = $_POST['ewallet'];
      $pemesanan->IsConfirm = $isConfirm; // Set nilai IsConfirm sebagai 0 atau false
      $pemesanan->save();

      header('Location: ' . BASE_URL . '?url=pemesanan/success');
      exit;
    } else {
      header('Location: ' . BASE_URL . 'pemesanan');
      exit;
    }
  }

  public function edit($id)
  {
    $pemesanan = Pemesanan::find($id);

    if ($pemesanan) {
      $this->view('pemesanan/edit', [
        'pemesanan' => $pemesanan,
        'users' => User::all(),
        'vaksins' => Vaksin::all(),
        'ewallets' => EWallet::all()
      ]);
    } else {
      header('Location: ' . BASE_URL . 'pemesanan');
      exit;
    }
  }

  // public function update($id)
  // {
  //   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //     $errors = [];

  //     // Validasi input
  //     if (empty($_POST['user_id'])) $errors[] = 'User is required';
  //     if (empty($_POST['vaksin_id'])) $errors[] = 'Vaksin is required';
  //     if (empty($_POST['schedule'])) $errors[] = 'Schedule is required';
  //     if (empty($_POST['location'])) $errors[] = 'Location is required';
  //     if (empty($_POST['ewallet_id'])) $errors[] = 'E-Wallet is required';

  //     if (!empty($errors)) {
  //       $pemesanan = Pemesanan::find($id);
  //       $this->view('pemesanan/edit', [
  //         'errors' => $errors,
  //         'pemesanan' => $pemesanan,
  //         'users' => User::all(),
  //         'vaksins' => Vaksin::all(),
  //         'ewallets' => EWallet::all()
  //       ]);
  //       return;
  //     }

  //     // Update data pemesanan
  //     $pemesanan = Pemesanan::find($id);
  //     $pemesanan->UserID = $_POST['user_id'];
  //     $pemesanan->VaksinID = $_POST['vaksin_id'];
  //     $pemesanan->Schedule = $_POST['schedule'];
  //     $pemesanan->Location = $_POST['location'];
  //     $pemesanan->EWalletID = $_POST['ewallet_id'];
  //     $pemesanan->IsConfirm = isset($_POST['is_confirm']);
  //     $pemesanan->save();

  //     header('Location: ' . BASE_URL . 'pemesanan');
  //     exit;
  //   } else {
  //     header('Location: ' . BASE_URL . 'pemesanan');
  //     exit;
  //   }
  // }

  public function update($id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $errors = [];

      // Validasi input
      if (empty($_POST['user_id'])) $errors[] = 'User is required';
      if (empty($_POST['vaksin_id'])) $errors[] = 'Vaksin is required';
      if (empty($_POST['schedule'])) $errors[] = 'Schedule is required';
      if (empty($_POST['location'])) $errors[] = 'Location is required';
      if (empty($_POST['ewallet_id'])) $errors[] = 'E-Wallet is required';

      // Jika ada kesalahan, kembali ke form edit
      if (!empty($errors)) {
        $pemesanan = Pemesanan::find($id);
        $this->view('pemesanan/edit', [
          'errors' => $errors,
          'pemesanan' => $pemesanan,
          'users' => User::all(),
          'vaksins' => Vaksin::all(),
          'ewallets' => EWallet::all()
        ]);
        return;
      }

      // Ambil data pemesanan, pastikan data dengan ID tersebut ada
      $pemesanan = Pemesanan::find($id);
      if (!$pemesanan) {
        // Redirect jika data pemesanan tidak ditemukan
        header('Location: ' . BASE_URL . '/pemesanan');
        exit;
      }

      // Update data pemesanan
      $pemesanan->UserID = $_POST['user_id'];
      $pemesanan->VaksinID = $_POST['vaksin_id'];
      $pemesanan->Schedule = $_POST['schedule'];
      $pemesanan->Location = $_POST['location'];
      $pemesanan->EWalletID = $_POST['ewallet_id'];
      $pemesanan->IsConfirm = isset($_POST['is_confirm']) ? 1 : 0; // pastikan boolean tersimpan dengan benar
      $pemesanan->save();

      // Redirect setelah sukses update
      header('Location: ' . BASE_URL . '/pemesanan');
      exit;
    } else {
      // Redirect jika bukan metode POST
      header('Location: ' . BASE_URL . '/pemesanan');
      exit;
    }
  }


  public function delete($id)
  {
    $pemesanan = Pemesanan::find($id);
    if ($pemesanan) {
      Pemesanan::delete($id);
    }
    header('Location: ' . BASE_URL . 'pemesanan');
    exit;
  }
}
