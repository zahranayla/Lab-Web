@extends('layouts.master')

@section('title', 'Contact Us')

@section('content')
<style>
    .contact-section {
        background-color: #f9f9f9;
        padding: 50px 0;
    }
    .contact-form, .recipe-recommendation {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }
    h2, h4 {
        color: #333;
    }
    .custom-bg2 {
    background-color: #ccd1db;
    width: 100vw; 
    margin-left: calc((100% - 100vw) / 2); 

}

</style>

<section class="contact-section custom-bg2">
    <div class="container">
        <!-- Section Title -->
        <h2 class="text-center mb-5">Get in Touch with <span style="color: #dc3545;">QuickMeals</span></h2>
        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-6 contact-form">
                <h4>Contact Us</h4>
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" placeholder="Write your message here" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            
            <!-- Recipe Recommendation Form -->
            <div class="col-md-6 recipe-recommendation">
                <h4>Recommend a Recipe</h4>
                <form>
                    <div class="mb-3">
                        <label for="recipe-name" class="form-label">Recipe Name</label>
                        <input type="text" class="form-control" id="recipe-name" placeholder="Enter the recipe name" required>
                    </div>
                    <div class="mb-3">
                        <label for="ingredients" class="form-label">Ingredients</label>
                        <textarea class="form-control" id="ingredients" rows="3" placeholder="List the ingredients" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instructions</label>
                        <textarea class="form-control" id="instructions" rows="4" placeholder="Provide the cooking instructions" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Recommend Recipe</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
