<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<style>
    .success-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 60vh;
        padding: 20px;
    }
    .success-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        padding: 50px 40px;
        text-align: center;
        max-width: 500px;
        width: 100%;
        animation: slideUp 0.6s ease-out;
    }
    .check-icon-wrapper {
        width: 100px;
        height: 100px;
        background: #d1e7dd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        color: #198754;
        font-size: 50px;
        animation: scaleIn 0.5s ease-out 0.3s both;
    }
    .success-title {
        font-weight: 800;
        color: #212529;
        margin-bottom: 15px;
        font-size: 28px;
    }
    .success-desc {
        color: #6c757d;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    .btn-home {
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s;
    }
    .btn-home:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.5); }
        to { opacity: 1; transform: scale(1); }
    }
</style>

<div class="success-container">
    <div class="success-card">
        <div class="check-icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
              <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
            </svg>
        </div>
        
        <h2 class="success-title">Pendaftaran Berhasil!</h2>
        
        <p class="success-desc">
            Terima kasih telah mendaftar. Data Anda telah kami terima dan akan segera diproses oleh tim kami. 
            Informasi selanjutnya akan dikirimkan melalui email atau WhatsApp yang terdaftar.
        </p>
        
        <a href="<?= base_url('/') ?>" class="btn btn-primary btn-home">Kembali ke Beranda</a>
    </div>
</div>

<?= $this->endSection() ?>
