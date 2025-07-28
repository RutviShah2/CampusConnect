// Utility: Apply multiple styles
function applyStyles(el, styles) {
  for (let k in styles) el.style[k] = styles[k];
}

// 1. Smooth Theme Toggle
document.head.insertAdjacentHTML('beforeend', `<style>body[data-theme]{transition: background 0.5s, color 0.5s;}</style>`);

// 2. Scroll-to-top button
(() => {
  const btn = document.createElement('button');
  btn.innerText = '↑';
  applyStyles(btn, {
    position: 'fixed', bottom: '30px', right: '30px', padding: '12px 16px', fontSize: '20px',
    borderRadius: '50%', border: 'none', background: '#333', color: '#fff', cursor: 'pointer',
    boxShadow: '0 2px 8px rgba(0,0,0,0.2)', opacity: '0', pointerEvents: 'none',
    transition: 'opacity 0.3s', zIndex: '9999'
  });
  document.body.appendChild(btn);
  window.addEventListener('scroll', () => {
    let show = window.scrollY > 200;
    btn.style.opacity = show ? '1' : '0';
    btn.style.pointerEvents = show ? 'auto' : 'none';
  });
  btn.onclick = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
    showToast('Back to top!');
  };
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
function showToast(msg) {
  const toast = document.createElement('div');
  toast.textContent = msg;
  applyStyles(toast, {
    position: 'fixed', bottom: '60px', left: '50%', transform: 'translateX(-50%)',
    background: '#222', color: '#fff', padding: '10px 24px', borderRadius: '6px',
    fontSize: '16px', boxShadow: '0 2px 8px rgba(0,0,0,0.2)', opacity: '0',
    transition: 'opacity 0.4s', zIndex: '10002'
  });
  document.body.appendChild(toast);
  setTimeout(() => (toast.style.opacity = '1'), 10);
  setTimeout(() => {
    toast.style.opacity = '0';
    setTimeout(() => toast.remove(), 400);
  }, 1800);
}

