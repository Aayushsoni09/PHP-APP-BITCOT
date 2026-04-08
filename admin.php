<?php
require_once __DIR__ . '/includes/db.php';

$conn = getConnection();
$result = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
$rows = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
$count = count($rows);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin — Submissions</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Sora:wght@300;400;600&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #080b10;
    --surface: #0f1520;
    --border: #1e2d45;
    --accent: #00e5ff;
    --accent2: #7b61ff;
    --text: #d4dff0;
    --muted: #506080;
    --danger: #ff4d6d;
    --success: #00e5c0;
  }
  * { margin:0; padding:0; box-sizing:border-box; }
  body { background:var(--bg); color:var(--text); font-family:'Sora',sans-serif; min-height:100vh; }

  header {
    border-bottom: 1px solid var(--border);
    padding: 1.5rem 2.5rem;
    display: flex; align-items:center; justify-content:space-between;
    background: var(--surface);
  }
  header h1 { font-family:'Space Mono',monospace; font-size:1.1rem; color:var(--accent); letter-spacing:.08em; }
  header .badge {
    background: var(--accent2); color:#fff; font-family:'Space Mono',monospace;
    font-size:.75rem; padding:.3rem .8rem; border-radius:2rem;
  }
  a.back { color:var(--muted); text-decoration:none; font-size:.85rem; border:1px solid var(--border); padding:.4rem 1rem; border-radius:.4rem; transition:.2s; }
  a.back:hover { border-color:var(--accent); color:var(--accent); }

  main { padding: 2.5rem; max-width: 1200px; margin: 0 auto; }

  .empty { text-align:center; padding:5rem 2rem; color:var(--muted); font-family:'Space Mono',monospace; }
  .empty span { font-size:3rem; display:block; margin-bottom:1rem; }

  table { width:100%; border-collapse:collapse; margin-top:1rem; }
  thead tr { background:rgba(0,229,255,.05); }
  th { font-family:'Space Mono',monospace; font-size:.7rem; letter-spacing:.1em; color:var(--accent); padding:.85rem 1rem; text-align:left; border-bottom:1px solid var(--border); white-space:nowrap; }
  td { padding:.9rem 1rem; border-bottom:1px solid var(--border); font-size:.85rem; vertical-align:top; }
  tr:hover td { background:rgba(255,255,255,.02); }
  .id-cell { font-family:'Space Mono',monospace; color:var(--accent2); font-size:.75rem; }
  .email-cell { color:var(--accent); }
  .msg-cell { color:var(--muted); max-width:260px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; }
  .date-cell { font-family:'Space Mono',monospace; font-size:.72rem; color:var(--muted); white-space:nowrap; }
  .phone-cell { font-family:'Space Mono',monospace; font-size:.78rem; }
</style>
</head>
<body>
<header>
  <h1>// ADMIN — SUBMISSIONS</h1>
  <div style="display:flex;gap:1rem;align-items:center">
    <span class="badge"><?= $count ?> record<?= $count !== 1 ? 's' : '' ?></span>
    <a class="back" href="index.php">← Back to form</a>
  </div>
</header>
<main>
  <?php if ($count === 0): ?>
    <div class="empty"><span>📭</span>No submissions yet.</div>
  <?php else: ?>
  <table>
    <thead>
      <tr>
        <th>#ID</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Submitted At</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
      <tr>
        <td class="id-cell">#<?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['full_name']) ?></td>
        <td class="email-cell"><?= htmlspecialchars($row['email']) ?></td>
        <td class="phone-cell"><?= htmlspecialchars($row['phone'] ?: '—') ?></td>
        <td><?= htmlspecialchars($row['subject']) ?></td>
        <td class="msg-cell" title="<?= htmlspecialchars($row['message']) ?>"><?= htmlspecialchars($row['message']) ?></td>
        <td class="date-cell"><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php endif; ?>
</main>
</body>
</html>
