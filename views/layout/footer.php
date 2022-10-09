            <nav>
            	<a
            		href="<?php echo ROOT . "/"; ?>">Home</a>
            	<a
            		href="<?php echo ROOT . "/cart"; ?>">Carrinho</a>
            	<?php
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="' . ROOT . '/logout">Logout</a>';
                } else {
                    echo '<a href="' . ROOT . '/login">Login</a> ';
                    echo '<a href="' . ROOT . '/register">Criar Conta</a>';
                }
            		?>
            </nav>
            </main>
            </body>

            </html>