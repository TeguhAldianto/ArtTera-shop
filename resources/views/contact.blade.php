@extends('layouts.app')
@section('title', 'Get in Touch')

@section('content')
    <section class="contact-section" style="max-width: 800px; margin: 0 auto; padding: 4rem 2rem; text-align: center;">
        <h1 class="title" style="margin-bottom: 1.5rem;">Contact Support</h1>
        <p style="font-size: 1.6rem; color: var(--light-color); margin-bottom: 4rem;">We are here to help you 24/7.</p>

        <form action="" method="post" class="contact-form">
            <div class="input-grid">
                <div class="form-group">
                    <label for="contact-name">Name</label>
                    <input type="text" id="contact-name" name="name" class="modern-input" placeholder="enter your name…" autocomplete="name" required>
                </div>
                <div class="form-group">
                    <label for="contact-email">Email</label>
                    <input type="email" id="contact-email" name="email" class="modern-input" placeholder="enter your email…" autocomplete="email" spellcheck="false" required>
                </div>
            </div>

            <div class="form-group">
                <label for="contact-msg">Message</label>
                <textarea id="contact-msg" name="msg" class="modern-input" rows="5" placeholder="write your message…" required></textarea>
            </div>

            <button type="submit" class="btn" style="width: 100%;">Send Message</button>
        </form>
    </section>
@endsection

@push('styles')
<style>
    .contact-form { background: var(--white); padding: 4rem; border-radius: 1.6rem; box-shadow: 0 10px 30px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.05); text-align: left; }
    .input-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem; }
    .form-group label { display: block; font-size: 1.4rem; margin-bottom: 0.8rem; font-weight: 500; color: var(--black); }
    .modern-input { width: 100%; padding: 1.2rem 1.5rem; border: 1px solid #e0e0e0; border-radius: 0.8rem; font-size: 1.6rem; font-family: inherit; transition: border-color 0.2s, box-shadow 0.2s; }
    .modern-input:focus { outline: none; border-color: var(--yellow); box-shadow: 0 0 0 3px rgba(180, 114, 80, 0.2); }
    @media (max-width: 768px) {
        .input-grid { grid-template-columns: 1fr; }
        .contact-form { padding: 2.5rem; }
    }
</style>
@endpush
