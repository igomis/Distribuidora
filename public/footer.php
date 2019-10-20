            <br class="divisor" />
            <div id="pie">
                <form action='categories.php' method='post'>
                    <!-- Botón del mismo tipo que los demás -->
                    <input type='submit' name='categories' class='boton' style='width:100%;' value='Tornar Categories' ?>
                </form>
                <form action='logoff.php' method='post'>
                    <!-- Botón del mismo tipo que los demás -->
                    <input type='submit' name='desconectar' class='boton' style='width:100%;' value='Desconectar usuario <?= $_SESSION['user']->mailAdress ?>'/>
                </form>
            </div>
        </div>
    </body>
</html>