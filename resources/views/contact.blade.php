@extends('layouts.app')
@section('title', 'Get in Touch')

@section('content')
    <section class="contact-section" style="max-width: 800px; margin: 0 auto; text-align: center;">
        <h1 class="title">Contact Support</h1>
        <p style="font-size: 1.6rem; color: var(--light-color); margin-bottom: 4rem;">We are here to help you 24/7.</p>

        <form action="" method="post" style="background: var(--white); padding: 4rem; border-radius: var(--radius); box-shadow: var(--box-shadow); border: var(--border); text-align: left;">
            <div class="input-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label for="contact-name" style="font-size: 1.4rem;">Name</label>
                    <input type="text" id="contact-name" name="name" class="modern-input" placeholder="enter your name…" autocomplete="name" required>
                </div>
                <div>
                    <label for="contact-email" style="font-size: 1.4rem;">Email</label>
                    <input type="email" id="contact-email" name="email" class="modern-input" placeholder="enter your email…" autocomplete="email" spellcheck="false" required>
                </div>
            </div>

            <div style="margin-bottom: 2rem;">
                <label for="contact-msg" style="font-size: 1.4rem;">Message</label>
                <textarea id="contact-msg" name="msg" class="modern-input" rows="5" placeholder="write your message…" required></textarea>
            </div>

            <button type="submit" class="btn" style="width: 100%;">Send Message</button>
        </form>
    </section>
@endsection
