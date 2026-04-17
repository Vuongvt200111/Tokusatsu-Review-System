<link rel="stylesheet" href="<?= BASE_URL ?>/css/contact_us.css">
<div class="contact-admin-wrapper">
    <div class="container">
        <div class="row justify-content-center w-100 m-0">
            <div class="col-md-10 col-lg-8">
                
                <div class="card contact-card">
                    <div class="contact-header">
                        CONTACT THE ADMIN
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <?php if($error_msg): ?> 
                            <div class="alert alert-danger fw-bold py-2"><?= $error_msg ?></div> 
                        <?php endif; ?>
                        
                        <?php if($success_msg): ?> 
                            <div class="alert alert-success fw-bold py-2"><?= $success_msg ?></div> 
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-4">
                                <label class="contact-label">Sending account:</label>
                                <input type="text" class="form-control contact-input-disabled" 
                                       value="<?= htmlspecialchars($_SESSION['name'] ?? 'User') ?>" disabled>
                                <small class="contact-small-text">The system will automatically identify you via User ID.</small>
                            </div>
                            
                            <div class="mb-4">
                                <label class="contact-label">The message I want to convey:</label>
                                <textarea name="user_message" rows="5" class="form-control contact-textarea" required minlength="1" maxlength="1000" placeholder="Enter your complaints, suggestions, or compliments about the handsome Admin here..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning fw-bold w-100 fs-5 text-dark shadow mt-3">
                                SEND
                            </button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>