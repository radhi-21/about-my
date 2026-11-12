<?php
require __DIR__ . "/db.php";

$result = $connection->query(
    "SELECT * FROM profile ORDER BY id LIMIT 1"
);

$profile = $result->fetch_assoc();

if (!$profile) {
    exit("no data available");
}

function escape($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>About Me - Radhi</title>

    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <header class="site-header">
        <div class="header-wrap container">
            <a href="#hero" class="logo">
                Radhi<span>.</span>
            </a>

            <nav class="header-nav" aria-label="Main navigation">
                <a href="#about">About</a>
                <a href="#skills">Skills</a>
                <a href="#work">Work</a>
                <a href="#contact">Contact</a>
            </nav>

            <button type="button" id="theme-toggle" class="theme-toggle"
                aria-pressed="false"> Dark Mode
            </button>
        </div>
    </header>

    <main>
        <section id="hero" class="hero-section">
            <div class="container">
                <p class="tag">Hello, I’m</p>

                <h1><?= escape($profile["name"])?></h1>
                <h2><?= escape($profile["job"])?></h2>

                <p>
                   <?= escape($profile["intro"])?>
                </p>

                <div class="hero-actions">
                    <a href="#contact" class="btn btn-primary">
                        Get in Touch
                    </a>

                    <a href="#work" class="btn btn-sec">
                        See My Work
                    </a>
                </div>
            </div>
        </section>

        <section id="about">
            <div class="about-section container">
                <img
                    src="foto.png"
                    alt="Radhi Mohammad"
                    width="190"
                >

                <div class="about-content">
                    <p class="about-tag">About Me</p>

                    <h2 class="about-title">
                        A little about myself
                    </h2>

                    <p class="about-p">
                       <?= escape($profile["about"])?>
                    </p>
                </div>
            </div>
        </section>

        <section id="skills" class="section">
            <div class="skills-section container">
                <p class="skills-tag">What I Know</p>

                <h2 class="about-title">My Skills</h2>

                <div class="skills-grid">
                    <div class="skills-card">
                        <h3 class="skill-title">HTML</h3>

                        <p class="skill-des">
                            Structuring web pages with clean,
                            semantic markup.
                        </p>
                    </div>

                    <div class="skills-card">
                        <h3 class="skill-title">CSS</h3>

                        <p class="skill-des">
                            Styling and building responsive,
                            good-looking layouts.
                        </p>
                    </div>

                    <div class="skills-card">
                        <h3 class="skill-title">JavaScript</h3>

                        <p class="skill-des">
                            Adding interactivity and logic
                            to web pages.
                        </p>
                    </div>

                    <div class="skills-card">
                        <h3 class="skill-title">Git &amp; GitHub</h3>

                        <p class="skill-des">
                            Tracking my progress and sharing
                            my projects.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="work" class="section">
            <div class="work-section container">
                <p class="skills-tag">Portfolio</p>

                <h2 class="about-title">My Previous Work</h2>

                <div class="work-grid">
                    <div class="work-card">
                        <div class="work-card-num">1</div>

                        <h3 class="work-card-title">
                            Personal About Page
                        </h3>

                        <p class="work-card-des">
                            A simple bio/about page built
                            with HTML and CSS basics.
                        </p>
                    </div>

                    <div class="work-card">
                        <div class="work-card-num">2</div>

                        <h3 class="work-card-title">
                            Landing Page Practice
                        </h3>

                        <p class="work-card-des">
                            A practice landing page focused
                            on layout and styling.
                        </p>
                    </div>

                    <div class="work-card">
                        <div class="work-card-num">3</div>

                        <h3 class="work-card-title">
                            This Bio Page
                        </h3>

                        <p class="work-card-des">
                            A full portfolio-style page:
                            hero, about, skills and more.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="section">
            <div class="container">
                <p class="skills-tag">Get In Touch</p>

                <h2>Contact Me</h2>

                <p>
                    Have a question or just want to say hi?
                    Fill out the form below.
                </p>

                <form action="F.php" method="post" class="contact-form">
                    
                    <div class="form-group">
                        <label for="name">Name</label>

                        <input type="text" id="name" name="name" placeholder="Enter your name" autocomplete="name"
                         maxlength="100" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>

                        <input type="email" id="email"  name="email" placeholder="Enter your email" autocomplete="email"
                            maxlength="254" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>

                        <textarea id="message" name="message" rows="6" placeholder="Write your message"
                        maxlength="5000" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        send Message
                    </button>
                </form>

                <p>
                    Email:
                    <a href="mailto:<?= escape(trim($profile["email"]))?>">
                        <?= escape(trim($profile["email"]))?>           
                         </a>
                </p>

                <p>
                    Phone:
                    <a href="tel:<?= escape(trim($profile["phone"]))?>">
                       <?= escape(trim($profile["phone"]))?>
                    </a>
                </p>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>
                &copy; 2026 Radhi Mohammad. Built using HTML.
            </p>
        </div>
    </footer>
</body>
</html>