<?php
require_once 'config/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Analysis - Pasindu Premarathna</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">Pasindu Premarathna</a>
            </div>
            <div class="hamburger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="data-analysis.php" class="active">Data Analysis</a></li>
                <li><a href="it-profession.php">IT Profession</a></li>
                <li><a href="#contact">Contact</a></li>
                <?php if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                <li><a href="admin/index.php" class="admin-link">Admin</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Transforming data into actionable insights</h1>
                <p>As a data analyst, I specialize in extracting meaningful insights from complex datasets to drive informed decision-making. With expertise in statistical analysis, data visualization, and predictive modeling, I help organizations uncover patterns and trends that lead to strategic advantages and operational improvements.</p>
                <p>My analytical approach combines technical proficiency with business acumen, ensuring that data-driven recommendations align with organizational goals and create tangible value. I'm passionate about telling compelling stories with data that inspire action and drive positive outcomes.</p>
            </div>
        </section>

        <section class="skills-section" id="skills">
            <h2>Data Analysis Skills</h2>
            <div class="skills-container" id="dynamic-skills">
                <?php
                // Get skills from database
                $query = "SELECT * FROM skills WHERE category = 'data-analysis' ORDER BY proficiency DESC";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($skill = mysqli_fetch_assoc($result)) {
                        echo '<div class="skill-card">';
                        echo '<div class="skill-icon"><i class="' . htmlspecialchars($skill['icon']) . '"></i></div>';
                        echo '<h3>' . htmlspecialchars($skill['title']) . '</h3>';
                        echo '<p>' . htmlspecialchars($skill['description']) . '</p>';
                        echo '<div class="skill-progress">';
                        echo '<div class="progress-bar"><div class="progress" style="width: ' . $skill['proficiency'] . '%;"></div></div>';
                        echo '<span class="progress-value">' . $skill['proficiency'] . '%</span>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No skills found in this category yet. Check back soon!</p>';
                }
                ?>
            </div>
        </section>

        <section class="projects-section" id="projects">
            <h2>Data Analysis Projects</h2>
            <div class="projects-container" id="dynamic-projects">
                <?php
                // Get projects from database
                $query = "SELECT * FROM projects WHERE category = 'data-analysis' ORDER BY created_at DESC";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($project = mysqli_fetch_assoc($result)) {
                        // Parse JSON fields
                        $tags = json_decode($project['tags'], true) ?: [];
                        $technologies = json_decode($project['technologies'], true) ?: [];
                        
                        echo '<div class="project-card">';
                        if (!empty($project['image'])) {
                            echo '<div class="project-image"><img src="' . htmlspecialchars($project['image']) . '" alt="' . htmlspecialchars($project['title']) . '"></div>';
                        }
                        echo '<div class="project-content">';
                        echo '<h3>' . htmlspecialchars($project['title']) . '</h3>';
                        echo '<p>' . htmlspecialchars($project['description']) . '</p>';
                        
                        // Display tags
                        if (!empty($tags)) {
                            echo '<div class="tags">';
                            foreach ($tags as $tag) {
                                echo '<span class="tag">' . htmlspecialchars($tag) . '</span>';
                            }
                            echo '</div>';
                        }
                        
                        // Display technologies if available
                        if (!empty($technologies)) {
                            echo '<div class="technologies">';
                            echo '<h4>Technologies Used:</h4>';
                            echo '<ul>';
                            foreach ($technologies as $tech) {
                                echo '<li>' . htmlspecialchars($tech) . '</li>';
                            }
                            echo '</ul>';
                            echo '</div>';
                        }
                        
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No projects found in this category yet. Check back soon!</p>';
                }
                ?>
            </div>
        </section>

        <section class="articles-section" id="articles">
            <h2>Data Analysis Articles & Insights</h2>
            <div class="articles-container" id="dynamic-articles">
                <?php
                // Get articles from database
                $query = "SELECT * FROM articles WHERE category = 'data-analysis' ORDER BY created_at DESC";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($article = mysqli_fetch_assoc($result)) {
                        // Parse JSON fields
                        $tags = json_decode($article['tags'], true) ?: [];
                        
                        echo '<div class="article-card">';
                        if (!empty($article['image'])) {
                            echo '<div class="article-image"><img src="' . htmlspecialchars($article['image']) . '" alt="' . htmlspecialchars($article['title']) . '"></div>';
                        }
                        echo '<div class="article-content">';
                        echo '<h3>' . htmlspecialchars($article['title']) . '</h3>';
                        echo '<p class="article-excerpt">' . htmlspecialchars($article['excerpt']) . '</p>';
                        
                        // Display tags
                        if (!empty($tags)) {
                            echo '<div class="tags">';
                            foreach ($tags as $tag) {
                                echo '<span class="tag">' . htmlspecialchars($tag) . '</span>';
                            }
                            echo '</div>';
                        }
                        
                        echo '<div class="article-meta">';
                        echo '<span class="article-date">' . date('M d, Y', strtotime($article['created_at'])) . '</span>';
                        echo '</div>';
                        
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No articles found in this category yet. Check back soon!</p>';
                }
                ?>
            </div>
        </section>
        
        <section class="data-tools-section">
            <h2>Data Analysis Tools I Use</h2>
            <div class="tools-container">
                <div class="tool-card">
                    <img src="images/tools/python.png" alt="Python">
                    <h3>Python</h3>
                    <p>For data manipulation, statistical analysis, and machine learning</p>
                </div>
                <div class="tool-card">
                    <img src="images/tools/r.png" alt="R">
                    <h3>R</h3>
                    <p>For statistical computing and advanced data visualization</p>
                </div>
                <div class="tool-card">
                    <img src="images/tools/tableau.png" alt="Tableau">
                    <h3>Tableau</h3>
                    <p>For interactive data visualization and business intelligence</p>
                </div>
                <div class="tool-card">
                    <img src="images/tools/sql.png" alt="SQL">
                    <h3>SQL</h3>
                    <p>For database querying and data extraction</p>
                </div>
                <div class="tool-card">
                    <img src="images/tools/powerbi.png" alt="Power BI">
                    <h3>Power BI</h3>
                    <p>For business analytics and interactive dashboards</p>
                </div>
                <div class="tool-card">
                    <img src="images/tools/excel.png" alt="Excel">
                    <h3>Excel</h3>
                    <p>For data analysis, modeling, and visualization</p>
                </div>
            </div>
        </section>
    </main>

    <footer id="contact">
        <div class="footer-content">
            <div class="contact-section">
                <h2>Contact Me</h2>
                <form class="contact-form" action="contact-process.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="data-analysis.php">Data Analysis</a></li>
                    <li><a href="it-profession.php">IT Profession</a></li>
                </ul>
            </div>
            <div class="social-links">
                <h3>Connect With Me</h3>
                <div class="social-icons">
                    <a href="https://linkedin.com/in/pasindupremarathna" target="_blank"><i class="fab fa-linkedin"></i></a>
                    <a href="https://github.com/pasindupremarathna" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://twitter.com/pasindupremar" target="_blank"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Pasindu Premarathna. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/script.js"></script>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>
