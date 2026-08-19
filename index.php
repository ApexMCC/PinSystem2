<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Apex One Pin System</title>

  <link rel="stylesheet" href="style.css" />

  <style>
    /*
     * Apex One PIN Access
     */

    .pin-container {
      width: 340px;
      max-width: 100%;
      margin: 0 auto;
    }

    .pin-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--text);
      margin-bottom: 6px;
    }

    .pin-description {
      font-size: 12px;
      color: var(--muted);
      margin-bottom: 18px;
    }

    #pinInput {
      width: 100%;
      padding: 11px 14px;
      font-size: 16px;
      color: var(--text);
      background: #111111;
      border: 1px solid var(--border);
      border-radius: 8px;
      outline: none;
      text-align: left;
      letter-spacing: 4px;
      transition: border-color 0.15s, box-shadow 0.15s;
    }

    #pinInput::placeholder {
      color: var(--muted);
      letter-spacing: 0;
    }

    #pinInput:focus {
      border-color: #ffffff;
      box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.08);
    }

    #continueBtn {
      width: 100%;
      margin-top: 10px;
      padding: 13px;
      background: var(--accent);
      color: var(--bg-dark);
      border: 1px solid var(--accent);
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition:
        background 0.15s,
        border-color 0.15s,
        transform 0.05s;
    }

    #continueBtn:hover {
      background: var(--accent-mid);
      border-color: var(--accent-mid);
    }

    #continueBtn:active {
      transform: scale(0.99);
    }

    #pinMessage {
      margin-top: 12px;
      min-height: 18px;
      font-size: 13px;
      text-align: center;
    }

    #pinMessage.error {
      color: #dc2626;
    }

    #pinMessage.success {
      color: #16a34a;
    }

    @media (max-width: 640px) {
      .pin-container {
        width: 100%;
        max-width: 340px;
      }
    }
  </style>
</head>

<body>

  <!-- Apex Logo -->
  <header class="top-logo">
    <img src="" alt="Apex" />
  </header>


  <!-- Main PIN Access -->
  <main class="card">

    <div class="pin-container">

      <div class="pin-title">
        Enter PIN
      </div>

      <div class="pin-description">
        Enter your access PIN to continue.
      </div>

      <input
        type="password"
        id="pinInput"
        inputmode="numeric"
        pattern="[0-9]*"
        maxlength="6"
        placeholder="Enter PIN"
        autocomplete="off"
        aria-label="Access PIN"
      />

      <button
        type="button"
        id="continueBtn"
      >
        Continue
      </button>

      <p
        id="pinMessage"
        role="status"
      ></p>

    </div>

  </main>


  <!-- Footer -->
  <footer class="footer">

    <span class="footer-logo">
      <img
        src=""
        alt="Apex logo"
      />
    </span>

    <p class="footer-legal">
      The Apex One Pin service and associated data products are owned and
      distributed by Apex MCC and its subsidiaries. Aegis By Apex MCC provides
      global support and service for these products. By authenticating into the
      Apex One system, you agree to the
      <a href="#" id="termsLink">Terms of Use</a>
      and
      <a href="#" id="privacyLink">Privacy Policy</a>.
    </p>

  </footer>


  <script>
    /*
     * ==========================================
     * APEX ONE PIN
     * ==========================================
     *
     * Change this PIN to whatever you want.
     *
     * IMPORTANT:
     * This is a client-side/serverless PIN.
     * It should NOT be used for sensitive
     * authentication because the PIN exists
     * inside the page source.
     */

    const ACCESS_PIN = "1200";

// PUT THIS ON AUTH SYSTEM
    const pinInput = document.getElementById("pinInput");
    const continueBtn = document.getElementById("continueBtn");
    const pinMessage = document.getElementById("pinMessage");


    function authenticate() {

      const enteredPin = pinInput.value.trim();

      pinMessage.className = "";
      pinMessage.textContent = "";


      if (!enteredPin) {

        pinMessage.className = "error";
        pinMessage.textContent = "Please enter your PIN.";

        pinInput.focus();

        return;
      }


      if (enteredPin === ACCESS_PIN) {

        pinMessage.className = "success";
        pinMessage.textContent = "Access granted.";

        /*
         * Change this to the page you want
         * users to reach after entering
         * the correct PIN.
         */

        setTimeout(() => {
          window.location.href = "dashboard.html";
        }, 400);

        return;
      }


      pinMessage.className = "error";
      pinMessage.textContent = "Invalid PIN.";

      pinInput.value = "";

      pinInput.focus();


      /* Error shake */

      pinInput.animate(
        [
          {
            transform: "translateX(0)"
          },
          {
            transform: "translateX(-6px)"
          },
          {
            transform: "translateX(6px)"
          },
          {
            transform: "translateX(-4px)"
          },
          {
            transform: "translateX(4px)"
          },
          {
            transform: "translateX(0)"
          }
        ],
        {
          duration: 300
        }
      );
    }


    /* Continue button */

    continueBtn.addEventListener("click", authenticate);


    /* Enter key */

    pinInput.addEventListener("keydown", function(event) {

      if (event.key === "Enter") {
        authenticate();
      }

    });


    /* Numbers only */

    pinInput.addEventListener("input", function() {

      this.value = this.value
        .replace(/[^0-9]/g, "")
        .slice(0, 6);

    });


    /*
     * Prevent the page from jumping when
     * Terms/Privacy links are clicked.
     *
     * Replace these with your real URLs
     * when you have the pages ready.
     */

    document.getElementById("termsLink").addEventListener("click", function(event) {
      event.preventDefault();
    });

    document.getElementById("privacyLink").addEventListener("click", function(event) {
      event.preventDefault();
    });

  </script>

</body>
</html>
