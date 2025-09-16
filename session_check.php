<?php
session_start();
$session_message = '';
if (!isset($_SESSION['username'])) {
    // Check cookie for "Remember Me"
    if (isset($_COOKIE['username'])) {
        $_SESSION['username'] = $_COOKIE['username'];
    } else {
        header('Location: login.php');
        exit;
    }
} else {
    if (!isset($_SESSION['session_notified'])) {
        $session_message = 'Session created!';
        $_SESSION['session_notified'] = true;
    }
    if (isset($_GET['session']) && $_GET['session'] == 'completed') {
        $session_message = 'Session completed!';
        unset($_SESSION['session_notified']);
    }
}
?>

<?php if (!empty($session_message)): ?>
  <div id="session-msg" style="margin: 10px 0; color: #fff; background: #6c63ff; border-radius: 8px; padding: 10px; font-weight: 600;">
    <?php echo $session_message; ?>
  </div>
<?php endif; ?>

<a href="logout.php?session=completed" class="confirmation-btn">Logout</a>

<div id="cookie-banner" style="display:none; position:fixed; bottom:20px; left:50%; transform:translateX(-50%); background:#333; color:#fff; padding:18px 28px; border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,0.13); z-index:9999;">
  This site uses cookies to enhance your experience. <br>
  <button onclick="acceptCookies()" style="margin:8px 8px 0 0; padding:7px 18px; border:none; border-radius:6px; background:#6c63ff; color:#fff; font-weight:600; cursor:pointer;">Accept</button>
  <button onclick="rejectCookies()" style="margin:8px 0 0 0; padding:7px 18px; border:none; border-radius:6px; background:#e74c3c; color:#fff; font-weight:600; cursor:pointer;">Reject</button>
</div>
<script>
  function getCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) return match[2];
    return null;
  }
  function setCookie(name, value, days) {
    let expires = '';
    if (days) {
      let date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = '; expires=' + date.toUTCString();
    }
    document.cookie = name + '=' + value + expires + '; path=/';
  }
  function acceptCookies() {
    setCookie('cookie_consent', 'accepted', 365);
    document.getElementById('cookie-banner').style.display = 'none';
  }
  function rejectCookies() {
    setCookie('cookie_consent', 'rejected', 365);
    document.getElementById('cookie-banner').style.display = 'none';
  }
  window.onload = function() {
    if (!getCookie('cookie_consent')) {
      document.getElementById('cookie-banner').style.display = 'block';
    }
  }
</script>