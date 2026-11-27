<?php
session_start();
$conn = new mysqli("db", "root", "rootpass", "glitchmarket");

$search = $_GET['q'] ?? '';
// VULNERABILITY 1: Direct concatenation allows SQL Injection
$query = "SELECT * FROM products WHERE name LIKE '%$search%' OR description LIKE '%$search%'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GlitchMarket | Hardware Store</title>
    <script src="./tailwind.js"></script>
</head>
<body class="bg-gray-900 text-gray-100 font-sans">
    <nav class="bg-gray-800 p-4 border-b border-gray-700 flex justify-between items-center">
        <a href="index.php" class="text-2xl font-bold text-emerald-400">GlitchMarket_</a>
        <div class="space-x-4">
            <a href="login.php" class="hover:text-emerald-400">Login</a>
            <a href="profile.php?id=2" class="hover:text-emerald-400">My Account</a>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto p-6">
        <form method="GET" class="mb-8 flex gap-2">
            <input type="text" name="q" placeholder="Search GPUs, keyboards, tools..." 
                   class="w-full p-3 rounded bg-gray-800 border border-gray-700 focus:outline-none focus:border-emerald-400">
            <button type="submit" class="bg-emerald-500 text-gray-900 font-bold px-6 py-3 rounded hover:bg-emerald-400">
                Search
            </button>
        </form>

        <?php if ($search): ?>
            <!-- VULNERABILITY 2: Unescaped output allows Reflected XSS -->
            <p class="mb-4 text-gray-400">Showing results for: <span class="text-white font-semibold"><?php echo $search; ?></span></p>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php if ($result): while($row = $result->fetch_assoc()): ?>
                <div class="bg-gray-800 p-5 rounded-lg border border-gray-700 flex flex-col justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white mb-2"><?php echo htmlspecialchars($row['name']); ?></h2>
                        <p class="text-gray-400 text-sm mb-4"><?php echo htmlspecialchars($row['description']); ?></p>
                    </div>
                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-700">
                        <span class="text-emerald-400 font-mono text-lg">$<?php echo $row['price']; ?></span>
                        <a href="product.php?id=<?php echo $row['id']; ?>" class="bg-gray-700 hover:bg-gray-600 px-3 py-1 rounded text-sm">
                            Inspect
                        </a>
                    </div>
                </div>
            <?php endwhile; else: ?>
                <!-- Exposing raw SQL errors aids Union/Error-based SQLi -->
                <div class="col-span-3 bg-red-900/50 border border-red-500 p-4 rounded text-red-200">
                    Database Error: <?php echo $conn->error; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
