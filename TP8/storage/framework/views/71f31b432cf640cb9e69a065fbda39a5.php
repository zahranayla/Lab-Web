

<?php $__env->startSection('title', 'About'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .custom-bg1 {
    background-color: #ccd1db;
    width: 100vw; 
    margin-left: calc((100% - 100vw) / 2);
}
</style>
<section class="p-5 custom-bg1" id="activities">
    <div class="container">
        <h2 class="text-center mb-4">About QuickMeals</h2>
        <p class="text-center"><span style="color: #dc3545;">QuickMeals</span> hadir untuk memberikan Anda resep-resep cepat dan mudah, dengan bahan-bahan sederhana dan langkah-langkah yang gampang diikuti. Kami percaya bahwa memasak haruslah menyenangkan dan tidak perlu ribet, sehingga siapa pun bisa menikmati proses memasak dan hasilnya.</p>
        <h4 class="text-center">-Menu Populer di <span style="color: #dc3545;">QuickMeals</span>-</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="Images/breakfast.jpg" class="card-img-top" alt="breakfast">
                    <div class="card-body">
                        <h5 class="card-title">Sarapan Sehat dan Praktis</h5>
                        <p class="card-text">Fuel Your Morning! Kami punya resep-resep sarapan sehat yang siap dalam hitungan menit.</p>
                        <a href="#" class="btn btn-primary">Fuel Me Up!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="Images/lunch.jpg" class="card-img-top" alt="lunch">
                    <div class="card-body">
                        <h5 class="card-title">Makan Siang Ringkas</h5>
                        <p class="card-text">Untuk Anda yang sibuk, coba pilihan resep makan siang praktis dan lezat yang cocok untuk mengisi tenaga di tengah hari.</p>
                        <a href="#" class="btn btn-primary">Let's Lunch!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="Images/dinner.jpg" class="card-img-top" alt="dinner">
                    <div class="card-body">
                        <h5 class="card-title">Makan Malam Nikmat</h5>
                        <p class="card-text">Dinner Vibes! Kami punya beragam pilihan resep makan malam yang mudah dibuat tapi tetap spesial.</p>
                        <a href="#" class="btn btn-primary">Bring on the Feast!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\zahra\TP8\resources\views/about.blade.php ENDPATH**/ ?>