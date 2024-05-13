<?php
include('auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="userlist.css">
    <link rel="icon" href="D:\web project\sgp\php\images\logo.png">
    <link rel="stylesheet" href="leederboard/leederboard.css">
    <title>Members || SkillSwap</title>
    <style>
        /* Your CSS styles */
        .filter {
            margin-left: 10px;
            cursor: pointer;
            color: #333; /* Text color for filter options */
        }

        .filter:hover {
            color: #007bff; /* Text color on hover for filter options */
        }

        .search-btn {
            cursor: pointer;
            background-color: #007bff; /* Background color for search button */
            color: #fff; /* Text color for search button */
            border: none;
            padding: 6px 12px;
            border-radius: 3px;
            margin-left: 10px;
        }

        .search-btn:hover {
            background-color: #0056b3; /* Background color on hover for search button */
        }

        #searchInput {
            padding: 6px 10px;
            border: 1px solid #ccc; /* Border color for search input */
            border-radius: 3px;
        }

        #searchInput:focus {
            outline: none;
            border-color: #007bff; /* Border color when input is focused */
        }

        /* Styles for the filter and search container */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #333; /* Header text color */
        }

        .header svg {
            margin-right: 5px;
            fill: #333; /* SVG icon fill color */
        }

        .header svg:hover {
            fill: #007bff; /* SVG icon fill color on hover */
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.html" class="logo">
            <!-- <i class='bx bx-code-alt'></i> -->
            <p>&ensp;</p>
            <img src="images/logo.png" alt="logo" width="34" height="34">
            <p>&ensp;</p>
            <p>&nbsp;</p>
            <div class="logo-name"><span>Skill</span>Swap</div>
        </a>
        <ul class="side-menu">
            <li><a href="save.php"><i class='bx bx-group'></i>Profile</a></li>
            <li class="active"><a href="members.html"><i class='bx bxs-dashboard'></i>Members</a></li>
            <li><a href="chat.html"><i class='bx bx-message-square-dots'></i>Peer Chat</a></li>
            <li><a href="feedback.html"><i class='bx bx-comment'></i>Feedback</a></li>
            
            
            
            </ul>
            <ul class="side-menu">
                <li>
                    <a href="logout.php" class="logout">
                        <i class='bx bx-log-out-circle'></i>
                        Logout
                    </a>
                </li>
            </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <!-- <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <<a href="#" class="notif">
                <i class='bx bx-bell bx-sm'></i>
                <span class="count">12</span>
            </a> 


            <a href="#" class="profile">
                <img src="images/logo.png">
            </a>
        </nav> -->
        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Our Co-Workers</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Top Contributors</a></li>
                    </ul>
                </div>
                <a href="#" class="report">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
                        <path
                            d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z" />
                    </svg>
                    <span>Leaderboard</span>
                </a>
            </div>

            <div class="bottom-data">
                <div class="orders">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Listed Skills</h3>
                        <div class="filter" id="filterSkills">Filter by Skills</div>
                        
                        <form id="searchForm">
                            <input type="search" id="searchInput" placeholder="Search...">
                            <button class="search-btn" type="submit"><i class='bx bx-search'></i></button>
                        </form>
                    </div>
                    <section class="table__body">
                        <table id="userTable">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>User</th>
                                    <th>Skills</th>
                                    <th>Ratings(coming soon)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch co-workers list from the database
                                $query = "SELECT * FROM users";
                                $result = $conn->query($query);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td><img src='" . $row['photo'] . "' alt='' />" . $row['username'] . "</td>";
                                        echo "<td>" . $row['skill'] . "</td>";
                                        echo "<td>" . $row['rating'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No co-workers found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script>
        // JavaScript for filtering
        document.addEventListener("DOMContentLoaded", function () {
            const tableBody = document.querySelector(".table__body tbody");
            const filterSkills = document.getElementById("filterSkills");
            const filterRatings = document.getElementById("filterRatings");
            const searchForm = document.getElementById("searchForm");
            const searchInput = document.getElementById("searchInput");
            const userTable = document.getElementById("userTable");

            // Filter by Skills
            filterSkills.addEventListener("click", function () {
                const filterValue = prompt("Enter skill to filter:");
                if (filterValue !== null) {
                    filterTable(2, filterValue.toLowerCase());
                }
            });

            

            // Search functionality
            searchForm.addEventListener("submit", function (e) {
                e.preventDefault();
                const searchTerm = searchInput.value.toLowerCase();
                filterTable(2, searchTerm); // Search in skills column
            });

            // Function to filter the table
            function filterTable(column, value) {
                const rows = userTable.rows;
                for (let i = 1; i < rows.length; i++) {
                    const cell = rows[i].cells[column];
                    if (cell) {
                        const cellText = cell.textContent.toLowerCase();
                        if (cellText.includes(value)) {
                            rows[i].style.display = "";
                        } else {
                            rows[i].style.display = "none";
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
