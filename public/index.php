<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>College Appointment System</title>

<style>
/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Splash Screen */
#splash {
    position: fixed;
    width: 100%;
    height: 100vh;
    background: url("../assets/college.jpg") no-repeat center center/cover;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: zoom 2.5s ease-in-out forwards;
    z-index: 10;
}

@keyframes zoom {
    from { transform: scale(1); }
    to { transform: scale(1.1); }
}

/* Main Screen */
#main {
    display: none;
    height: 100vh;
    background: #f5f5f5;
}

/* Top bar */
.topbar {
    height: 60px;
    background: #2e7d32;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 20px;
    color: white;
}

/* Three dots */
.menu {
    font-size: 28px;
    cursor: pointer;
    position: relative;
}

/* Dropdown */
.dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 40px;
    background: white;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    border-radius: 6px;
    overflow: hidden;
}

.dropdown a {
    display: block;
    padding: 12px 20px;
    text-decoration: none;
    color: #333;
}

.dropdown a:hover {
    background: #f0f0f0;
}

/* Center content */
.center {
    height: calc(100vh - 60px);
    display: flex;
    justify-content: center;
    align-items: center;
}

.center h1 {
    font-size: 36px;
    color: #1e3a5f;
}
</style>
</head>

<body>

<!-- SPLASH SCREEN -->
<div id="splash"></div>

<!-- MAIN SCREEN -->
<div id="main">
    <div class="topbar">
        <div class="menu" onclick="toggleMenu()">⋮
            <div class="dropdown" id="dropdown">
                <a href="student_register.php">🧑‍🎓 Student</a>
                <a href="faculty_register.php">👨‍🏫 Faculty</a>
            </div>
        </div>
    </div>

    <div class="center">
        <h1>SARVAJANIK COLLEGE OF ENGINEERING AND TECHNOLOGY</h1>
    </div>
</div>

<script>
/* Hide splash after 2.5 seconds */
setTimeout(() => {
    document.getElementById("splash").style.display = "none";
    document.getElementById("main").style.display = "block";
}, 2500);

/* Toggle menu */
function toggleMenu() {
    let menu = document.getElementById("dropdown");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
</script>

</body>
</html>
