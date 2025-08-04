// Utility: Apply multiple styles
function applyStyles(el, styles) {
  for (let k in styles) el.style[k] = styles[k];
}

// 1. Smooth Theme Toggle
document.head.insertAdjacentHTML('beforeend', `<style>body[data-theme]{transition: background 0.5s, color 0.5s;}</style>`);

// 2. Scroll-to-top button (Updated for Mobile)
(() => {
  const btn = document.createElement('button');
  btn.innerText = '↑';
  
  // Check if mobile
  const isMobile = window.innerWidth <= 768;
  
  applyStyles(btn, {
    position: 'fixed', 
    bottom: isMobile ? '20px' : '30px', 
    right: isMobile ? '20px' : '30px', 
    padding: isMobile ? '10px 14px' : '12px 16px', 
    fontSize: isMobile ? '18px' : '20px',
    borderRadius: '50%', 
    border: 'none', 
    background: '#667eea', 
    color: '#fff', 
    cursor: 'pointer',
    boxShadow: '0 4px 15px rgba(102, 126, 234, 0.3)', 
    opacity: '0', 
    pointerEvents: 'none',
    transition: 'all 0.3s ease', 
    zIndex: '9999',
    width: isMobile ? '45px' : '50px',
    height: isMobile ? '45px' : '50px'
  });
  
  document.body.appendChild(btn);
  
  window.addEventListener('scroll', () => {
    let show = window.scrollY > 200;
    btn.style.opacity = show ? '1' : '0';
    btn.style.pointerEvents = show ? 'auto' : 'none';
    btn.style.transform = show ? 'scale(1)' : 'scale(0.8)';
  });
  
  btn.onclick = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    showToast('Back to top! 🚀');
  };
  
  // Update button size on resize
  window.addEventListener('resize', () => {
    const mobile = window.innerWidth <= 768;
    btn.style.bottom = mobile ? '20px' : '30px';
    btn.style.right = mobile ? '20px' : '30px';
    btn.style.fontSize = mobile ? '18px' : '20px';
    btn.style.width = mobile ? '45px' : '50px';
    btn.style.height = mobile ? '45px' : '50px';
    btn.style.padding = mobile ? '10px 14px' : '12px 16px';
  });
})();

// 3. Page Load Animation
(() => {
  const overlay = document.createElement('div');
  const styles = {
    position: 'fixed', top: '0', left: '0', width: '100vw', height: '100vh',
    background: 'rgba(255,255,255,0.45)', backdropFilter: 'blur(16px)', zIndex: '10000',
    display: 'flex', alignItems: 'center', justifyContent: 'center', transition: 'opacity 0.7s'
  };
  applyStyles(overlay, styles);
  const text = document.createElement('div');
  text.innerText = 'CampusConnect';
  text.style.cssText = 'font-size:2rem; letter-spacing:2px; font-weight:600; text-shadow:0 2px 12px rgba(0,0,0,0.10);';
  overlay.appendChild(text);
  document.body.appendChild(overlay);
  window.addEventListener('DOMContentLoaded', () => {
    setTimeout(() => {
      overlay.style.opacity = '0';
      setTimeout(() => overlay.remove(), 700);
    }, 700);
  });
})();

// 7. Toast
// Mobile Toast Optimization
function showToast(msg) {
  const toast = document.createElement('div');
  toast.textContent = msg;
  
  const isMobile = window.innerWidth <= 768;
  
  applyStyles(toast, {
    position: 'fixed', 
    bottom: isMobile ? '80px' : '60px', 
    left: isMobile ? '20px' : '50%', 
    right: isMobile ? '20px' : 'auto',
    transform: isMobile ? 'none' : 'translateX(-50%)',
    background: 'rgba(45, 45, 45, 0.95)', 
    color: '#fff', 
    padding: isMobile ? '12px 20px' : '10px 24px', 
    borderRadius: '12px',
    fontSize: isMobile ? '14px' : '16px', 
    boxShadow: '0 8px 25px rgba(0,0,0,0.3)', 
    opacity: '0',
    transition: 'all 0.4s ease', 
    zIndex: '10002',
    backdropFilter: 'blur(10px)',
    border: '1px solid rgba(102, 126, 234, 0.2)',
    textAlign: 'center'
  });
  
  document.body.appendChild(toast);
  setTimeout(() => (toast.style.opacity = '1'), 10);
  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = isMobile ? 'translateY(20px)' : 'translateX(-50%) translateY(20px)';
    setTimeout(() => toast.remove(), 400);
  }, 2000);
}

// 8. Register Form Popup
document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const popup = document.getElementById("popup");
  const closeBtn = document.querySelector("#popup button");

  if (form && popup && closeBtn) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      popup.style.display = "block";
    });

    closeBtn.addEventListener("click", () => {
      popup.style.display = "none";
      form.reset();
      showToast("You’re all set! 🚀");
    });
  }
});

