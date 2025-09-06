<!-- Footer - teraz w jednym miejscu! -->
    <footer class="py-4 bg-dark text-white">
        <div class="container text-center">
            <!-- <div class="mb-3">
                <p class="mb-1">POŚREDNICTWO FINANSOWE EWELINA CECUGOWICZ-MINGE</p>
                <p class="mb-1">ul. Myszkowska 23, 42-421 Włodowice</p>
                <p class="mb-1">NIP: 6492229986</p>
            </div> -->
            <p>© <?php echo date("Y"); ?> Jura Quest. Wszelkie prawa zastrzeżone.</p>
            <p>
                <a href="polityka-prywatnosci.html" class="text-white">Polityka Prywatności</a> | 
                <a href="regulamin.html" class="text-white">Regulamin</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- Custom JS -->
    <script src="js/main.js"></script>

    <!-- Tutaj można dodać dodatkowe skrypty dla konkretnych podstron -->
    <?php if (!empty($extraScripts)) { echo $extraScripts; } ?>

</body>
</html>