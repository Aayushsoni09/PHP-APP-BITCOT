<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact — PHP MySQL App</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Sora:wght@200;300;400;600;700&display=swap" rel="stylesheet">
<style>
/* ── Reset & Variables ── */
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
:root {
  --bg:       #06080f;
  --panel:    #0c1018;
  --card:     #101620;
  --border:   #1c2a3d;
  --accent:   #00e5ff;
  --accent2:  #7b61ff;
  --glow:     rgba(0,229,255,.18);
  --text:     #cdd8ee;
  --muted:    #4a607f;
  --error:    #ff4d6d;
  --success:  #00e5c0;
  --input-bg: #080d14;
}

html { scroll-behavior: smooth; }
body {
  background: var(--bg);
  color: var(--text);
  font-family: 'Sora', sans-serif;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  overflow-x: hidden;
}

/* ── Background FX ── */
body::before {
  content: '';
  position: fixed; inset: 0;
  background:
    radial-gradient(ellipse 60% 50% at 15% 20%, rgba(0,229,255,.06) 0%, transparent 60%),
    radial-gradient(ellipse 40% 60% at 85% 80%, rgba(123,97,255,.07) 0%, transparent 55%);
  pointer-events: none; z-index: 0;
}

/* ── Grid overlay ── */
body::after {
  content: '';
  position: fixed; inset: 0;
  background-image:
    linear-gradient(rgba(0,229,255,.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(0,229,255,.025) 1px, transparent 1px);
  background-size: 60px 60px;
  pointer-events: none; z-index: 0;
}

/* ── Header ── */
header {
  position: relative; z-index: 10;
  padding: 1.25rem 2.5rem;
  border-bottom: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
  backdrop-filter: blur(12px);
  background: rgba(6,8,15,.75);
}
.logo {
  font-family: 'Space Mono', monospace;
  font-size: .85rem;
  color: var(--accent);
  letter-spacing: .12em;
  text-decoration: none;
}
.logo span { color: var(--muted); }
nav a {
  font-family: 'Space Mono', monospace;
  font-size: .75rem;
  color: var(--muted);
  text-decoration: none;
  border: 1px solid var(--border);
  padding: .4rem 1rem;
  border-radius: .35rem;
  transition: all .2s;
}
nav a:hover { color: var(--accent); border-color: var(--accent); box-shadow: 0 0 12px var(--glow); }

/* ── Main layout ── */
main {
  position: relative; z-index: 1;
  flex: 1;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
  max-width: 1100px;
  width: 100%;
  margin: 4rem auto;
  padding: 0 2rem;
}
@media (max-width: 780px) {
  main { grid-template-columns: 1fr; margin: 2rem auto; }
  .hero { display: none; }
}

/* ── Hero / Left ── */
.hero {
  display: flex; flex-direction: column; justify-content: center;
  padding-right: 4rem;
}
.hero-eyebrow {
  font-family: 'Space Mono', monospace;
  font-size: .7rem;
  letter-spacing: .18em;
  color: var(--accent);
  margin-bottom: 1.4rem;
  display: flex; align-items: center; gap: .6rem;
}
.hero-eyebrow::before {
  content: '';
  display: inline-block; width: 30px; height: 1px;
  background: var(--accent);
}
.hero h2 {
  font-size: 2.8rem;
  font-weight: 700;
  line-height: 1.12;
  margin-bottom: 1.5rem;
  letter-spacing: -.02em;
}
.hero h2 .hl {
  background: linear-gradient(135deg, var(--accent), var(--accent2));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.hero p {
  color: var(--muted);
  font-size: .95rem;
  line-height: 1.75;
  font-weight: 300;
  margin-bottom: 2.5rem;
}
.feature-list { list-style: none; display: flex; flex-direction: column; gap: .85rem; }
.feature-list li {
  display: flex; align-items: center; gap: .75rem;
  font-size: .85rem; color: var(--muted);
}
.feature-list li::before {
  content: '◆';
  font-size: .5rem;
  color: var(--accent);
  flex-shrink: 0;
}

/* ── Card / Form ── */
.card {
  background: var(--card);
  border: 1px solid var(--border);
  border-radius: 1.25rem;
  padding: 2.5rem;
  position: relative;
  overflow: hidden;
}
.card::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; height: 2px;
  background: linear-gradient(90deg, transparent, var(--accent), var(--accent2), transparent);
}

.card-title {
  font-family: 'Space Mono', monospace;
  font-size: .75rem;
  letter-spacing: .14em;
  color: var(--muted);
  margin-bottom: 2rem;
  text-transform: uppercase;
}

/* ── Form Fields ── */
.field { margin-bottom: 1.4rem; }
.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

label {
  display: block;
  font-size: .75rem;
  font-weight: 600;
  letter-spacing: .06em;
  color: var(--muted);
  text-transform: uppercase;
  margin-bottom: .5rem;
}
label .req { color: var(--accent); margin-left: .2rem; }

input, textarea {
  width: 100%;
  background: var(--input-bg);
  border: 1px solid var(--border);
  border-radius: .55rem;
  padding: .8rem 1rem;
  color: var(--text);
  font-family: 'Sora', sans-serif;
  font-size: .9rem;
  outline: none;
  transition: border-color .2s, box-shadow .2s;
  caret-color: var(--accent);
}
input::placeholder, textarea::placeholder { color: var(--muted); opacity: .6; }
input:focus, textarea:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(0,229,255,.1);
}
input.error, textarea.error { border-color: var(--error) !important; box-shadow: 0 0 0 3px rgba(255,77,109,.1) !important; }
textarea { resize: vertical; min-height: 110px; }

/* ── Button ── */
.btn {
  width: 100%;
  padding: .95rem;
  background: linear-gradient(135deg, var(--accent) 0%, var(--accent2) 100%);
  color: #080b10;
  font-family: 'Space Mono', monospace;
  font-size: .85rem;
  font-weight: 700;
  letter-spacing: .1em;
  border: none;
  border-radius: .6rem;
  cursor: pointer;
  margin-top: .5rem;
  transition: transform .15s, box-shadow .2s, opacity .2s;
  position: relative;
  overflow: hidden;
}
.btn::after {
  content: '';
  position: absolute; inset: 0;
  background: linear-gradient(135deg, transparent 30%, rgba(255,255,255,.15));
  opacity: 0; transition: opacity .2s;
}
.btn:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,229,255,.3); }
.btn:hover::after { opacity: 1; }
.btn:active { transform: translateY(0); }
.btn:disabled { opacity: .55; cursor: not-allowed; transform: none; }
.btn .spinner { display: none; }
.btn.loading .btn-text { display: none; }
.btn.loading .spinner { display: inline; }

/* ── Alerts ── */
.alert {
  display: none;
  border-radius: .6rem;
  padding: 1rem 1.2rem;
  font-size: .85rem;
  margin-top: 1.25rem;
  line-height: 1.5;
  animation: slideIn .3s ease;
}
.alert.show { display: block; }
.alert-error { background: rgba(255,77,109,.1); border: 1px solid rgba(255,77,109,.3); color: #ff8099; }
.alert-success { background: rgba(0,229,192,.1); border: 1px solid rgba(0,229,192,.3); color: var(--success); }
.alert ul { padding-left: 1.2rem; margin-top: .4rem; }
.alert ul li { margin-top: .25rem; }

/* ── Success state ── */
.success-state {
  display: none;
  text-align: center;
  padding: 2rem 0;
  animation: fadeIn .5s ease;
}
.success-state.show { display: block; }
.success-icon {
  font-size: 3.5rem;
  margin-bottom: 1.25rem;
  filter: drop-shadow(0 0 20px var(--success));
  animation: pulse 2s ease-in-out infinite;
}
.success-state h3 {
  font-size: 1.4rem;
  margin-bottom: .5rem;
  background: linear-gradient(135deg, var(--success), var(--accent));
  -webkit-background-clip: text; -webkit-text-fill-color: transparent;
}
.success-state p { color: var(--muted); font-size: .9rem; margin-bottom: 1.5rem; }
.btn-outline {
  display: inline-block;
  font-family: 'Space Mono', monospace;
  font-size: .78rem;
  color: var(--accent);
  border: 1px solid var(--accent);
  padding: .65rem 1.5rem;
  border-radius: .5rem;
  text-decoration: none;
  cursor: pointer;
  background: none;
  transition: .2s;
}
.btn-outline:hover { background: rgba(0,229,255,.08); }

/* ── Footer ── */
footer {
  position: relative; z-index: 1;
  text-align: center;
  padding: 1.5rem;
  border-top: 1px solid var(--border);
  font-family: 'Space Mono', monospace;
  font-size: .68rem;
  color: var(--muted);
  letter-spacing: .08em;
}

/* ── Animations ── */
@keyframes slideIn { from { opacity:0; transform:translateY(-8px) } to { opacity:1; transform:none } }
@keyframes fadeIn  { from { opacity:0 } to { opacity:1 } }
@keyframes pulse   { 0%,100% { transform: scale(1) } 50% { transform: scale(1.08) } }
</style>
</head>
<body>

<header>
  <a class="logo" href="index.php">PHP<span>//</span>MYSQL</a>
  <nav>
    <a href="admin.php">Admin Panel →</a>
  </nav>
</header>

<main>

  <!-- ── Left: Hero ── -->
  <div class="hero">
    <p class="hero-eyebrow">PHP + MySQL Application</p>
    <h2>Send us a<br><span class="hl">message.</span></h2>
    <p>A demonstration of a full-stack PHP web application with MySQL persistence, input validation, and prepared statements for SQL injection prevention.</p>
    <ul class="feature-list">
      <li>Server-side input validation</li>
      <li>Prepared statements (SQL injection safe)</li>
      <li>Async AJAX form submission</li>
      <li>Duplicate email detection</li>
      <li>Admin panel to view all entries</li>
    </ul>
  </div>

  <!-- ── Right: Form ── -->
  <div class="card">
    <p class="card-title">// New Submission</p>

    <!-- Form -->
    <div id="form-wrap">
      <div class="field-row">
        <div class="field">
          <label>Full Name <span class="req">*</span></label>
          <input type="text" id="full_name" placeholder="Aayush Sharma" autocomplete="name">
        </div>
        <div class="field">
          <label>Email <span class="req">*</span></label>
          <input type="email" id="email" placeholder="you@example.com" autocomplete="email">
        </div>
      </div>

      <div class="field-row">
        <div class="field">
          <label>Phone</label>
          <input type="tel" id="phone" placeholder="+91 98765 43210" autocomplete="tel">
        </div>
        <div class="field">
          <label>Subject <span class="req">*</span></label>
          <input type="text" id="subject" placeholder="e.g. General Enquiry">
        </div>
      </div>

      <div class="field">
        <label>Message <span class="req">*</span></label>
        <textarea id="message" placeholder="Write your message here..."></textarea>
      </div>

      <button class="btn" id="submitBtn" onclick="submitForm()">
        <span class="btn-text">SEND MESSAGE</span>
        <span class="spinner">⟳ SENDING...</span>
      </button>

      <div class="alert alert-error" id="errorAlert"></div>
    </div>

    <!-- Success State -->
    <div class="success-state" id="successState">
      <div class="success-icon">✦</div>
      <h3>Message Received!</h3>
      <p>Your submission has been stored in the database.<br>Entry ID: <span id="entryId" style="font-family:'Space Mono',monospace;color:var(--accent)"></span></p>
      <button class="btn-outline" onclick="resetForm()">Send Another</button>
    </div>
  </div>

</main>

<footer>BUILT WITH PHP · MYSQL · VANILLA JS — NO FRAMEWORK</footer>

<script>
async function submitForm() {
  const btn   = document.getElementById('submitBtn');
  const alert = document.getElementById('errorAlert');

  // Clear previous errors
  alert.className = 'alert';
  alert.innerHTML = '';
  document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));

  // Collect values
  const fields = {
    full_name: document.getElementById('full_name').value.trim(),
    email:     document.getElementById('email').value.trim(),
    phone:     document.getElementById('phone').value.trim(),
    subject:   document.getElementById('subject').value.trim(),
    message:   document.getElementById('message').value.trim(),
  };

  // Basic client-side checks
  const clientErrors = [];
  if (fields.full_name.length < 2)   clientErrors.push('Full name is required.');
  if (!fields.email.includes('@'))    clientErrors.push('Valid email is required.');
  if (fields.subject.length < 3)     clientErrors.push('Subject is required.');
  if (fields.message.length < 10)    clientErrors.push('Message must be at least 10 characters.');

  if (clientErrors.length) {
    showErrors(clientErrors);
    return;
  }

  // Disable button
  btn.disabled = true;
  btn.classList.add('loading');

  // Build FormData
  const fd = new FormData();
  for (const [k, v] of Object.entries(fields)) fd.append(k, v);

  try {
    const res  = await fetch('submit.php', { method: 'POST', body: fd });
    const data = await res.json();

    if (data.success) {
      document.getElementById('form-wrap').style.display = 'none';
      const ss = document.getElementById('successState');
      ss.classList.add('show');
      document.getElementById('entryId').textContent = '#' + data.id;
    } else {
      showErrors(data.errors || ['An unknown error occurred.']);
    }
  } catch (e) {
    showErrors(['Network error — please try again.']);
  } finally {
    btn.disabled = false;
    btn.classList.remove('loading');
  }
}

function showErrors(errors) {
  const alert = document.getElementById('errorAlert');
  const list  = errors.map(e => `<li>${e}</li>`).join('');
  alert.innerHTML = errors.length === 1
    ? `⚠ ${errors[0]}`
    : `⚠ Please fix the following:<ul>${list}</ul>`;
  alert.className = 'alert alert-error show';

  // Highlight relevant fields
  if (errors.some(e => e.toLowerCase().includes('name')))
    document.getElementById('full_name').classList.add('error');
  if (errors.some(e => e.toLowerCase().includes('email')))
    document.getElementById('email').classList.add('error');
  if (errors.some(e => e.toLowerCase().includes('subject')))
    document.getElementById('subject').classList.add('error');
  if (errors.some(e => e.toLowerCase().includes('message')))
    document.getElementById('message').classList.add('error');
}

function resetForm() {
  document.getElementById('successState').classList.remove('show');
  document.getElementById('form-wrap').style.display = 'block';
  ['full_name','email','phone','subject','message'].forEach(id => {
    document.getElementById(id).value = '';
    document.getElementById(id).classList.remove('error');
  });
  document.getElementById('errorAlert').className = 'alert';
}
</script>
</body>
</html>
