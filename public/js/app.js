// 1. Double-submit guard: the first submit locks the form and its button
document.addEventListener('submit', (e) => {
    const f = e.target;
    if (f.dataset.submitted) { e.preventDefault(); return; }
    f.dataset.submitted = '1';
    f.querySelectorAll('[type=submit]').forEach((b) => { b.disabled = true; b.classList.add('loading'); });
});

// Back/forward cache: never show a stale, already-submitted page
window.addEventListener('pageshow', (e) => { if (e.persisted) location.reload(); });

// 2. Show/hide password
document.querySelectorAll('[data-toggle-pass]').forEach((btn) => btn.addEventListener('click', () => {
    const i = document.getElementById(btn.dataset.togglePass);
    i.type = i.type === 'password' ? 'text' : 'password';
    btn.textContent = i.type === 'password' ? 'Show' : 'Hide';
}));

// 3. Lockout countdown (login page)
const lock = document.querySelector('[data-lockout]');
if (lock) {
    let left = parseInt(lock.dataset.lockout, 10);
    const count = lock.querySelector('[data-count]');
    const btn = document.querySelector('[data-lock-btn]');
    btn.disabled = true;
    const t = setInterval(() => {
        left--; count.textContent = Math.max(left, 0);
        if (left <= 0) { clearInterval(t); btn.disabled = false; lock.remove(); }
    }, 1000);
}

// 4. Quick-add tabs (dashboard)
const add = document.querySelector('.add');
if (add) {
    const show = (name) => {
        add.querySelectorAll('[data-tab]').forEach((b) => b.classList.toggle('on', b.dataset.tab === name));
        add.querySelectorAll('[data-pane]').forEach((p) => p.classList.toggle('on', p.dataset.pane === name));
    };
    add.querySelectorAll('[data-tab]').forEach((b) => b.addEventListener('click', () => show(b.dataset.tab)));
    show(add.dataset.open);
}
