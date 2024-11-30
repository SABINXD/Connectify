<div class="verify-container">
    
      <div class="header-bar">
        <p>Connectify</p>
      </div>

      <div class="verify-panel">
        <h1>Verify Yourself</h1>
        <div class="separating-line-verify"></div>
        <p>Enter 6 Digit code that you got have on email:</p>
        <form method="post" action="">
        <input name="code"
          type="text"
          class="codenumber"
          placeholder="Enter your  6 Digit  code"
          
        />
        <?= showError('verify_code') ?>
        <button type="submit" class="code-verify">Verify</button>
        </form>
      </div>
    </div>