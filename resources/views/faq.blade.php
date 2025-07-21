@extends('layouts.app')

@section('title', 'Help Center & FAQ')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">Help Center & Frequently Asked Questions</h2>

    <div class="accordion accordion-flush" id="faqAccordion">
        {{-- Accordion Questions --}}
        @php
            $faqs = [
                ['What is IPTV UK World?', 'IPTV UK World is a premium IPTV service that offers UK and international channels with high-quality streaming.'],
                ['How can I get a free trial?', 'You can request a free trial by clicking on the “Get Free Trial” button on our homepage and filling out the form.'],
                ['What payment methods are accepted?', 'We accept payments via PayPal and major credit/debit cards.'],
                ['How do I contact support?', 'You can contact us via the contact form, or directly on WhatsApp using the button provided on our site.']
            ];
        @endphp

        @foreach($faqs as $index => $faq)
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading{{ $index }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}" aria-expanded="false" aria-controls="faq{{ $index }}">
                    {{ $faq[0] }}
                </button>
            </h2>
            <div id="faq{{ $index }}" class="accordion-collapse collapse" aria-labelledby="faqHeading{{ $index }}" data-bs-parent="#faqAccordion">
                <div class="accordion-body">{{ $faq[1] }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Floating Chatbot --}}
<div id="faqBotBox" style="
    display: none;
    position: fixed;
    bottom: 90px;
    left: 20px;
    width: 320px;
    height: 400px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.3);
    z-index: 9999;
    flex-direction: column;
    padding: 10px;
    overflow: hidden;
">
    <h5 class="text-center fw-bold text-primary mb-2">Ask FAQ Bot</h5>
    <div id="chatMessages" style="
        flex: 1;
        overflow-y: auto;
        border: 1px solid #ccc;
        padding: 8px;
        border-radius: 10px;
        background: #f8f9fa;
        height: 230px;
    "></div>
    <div class="mt-2 mb-2">
        <small><strong>Popular Questions:</strong></small><br>
        <div class="d-flex flex-wrap gap-1 mt-1">
            <button class="btn btn-sm btn-outline-primary faq-question-button">What is IPTV?</button>
            <button class="btn btn-sm btn-outline-primary faq-question-button">How do I subscribe to IPTV UK World?</button>
            <button class="btn btn-sm btn-outline-primary faq-question-button">Can I use IPTV on Firestick?</button>
            <button class="btn btn-sm btn-outline-primary faq-question-button">How do I get a free trial?</button>


        </div>
    </div>
    <div class="input-group">
        <input type="text" id="userInput" class="form-control" placeholder="Type your question...">
        <button class="btn btn-primary" id="sendBtn">Send</button>
    </div>
</div>

{{-- Floating Icon --}}
<button id="chatbotToggle" style="
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 10000;
    background-color: #1d64e8;
    color: white;
    border: none;
    border-radius: 50%;
    width: 55px;
    height: 55px;
    font-size: 24px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    cursor: pointer;
">
    💬
</button>
<!-- Separate Section: Google Map -->
<section class="bg-light py-5 border-top">
    <div class="container-fluid">
        <h3 class="text-center fw-bold mb-4">📍 Our Location</h3>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="ratio ratio-16x9 rounded-4 shadow">
                    <iframe
                        src="https://www.google.com/maps?q={{ urlencode($contact->address) }}&output=embed"
                        allowfullscreen
                        loading="lazy"
                        style="border:0; width: 100%; height: 100%;"
                        class="rounded-4">
                    </iframe>
                </div>
                <p class="text-center mt-3 text-muted">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $contact->address }}
                </p>
            </div>
        </div>
    </div>
</section>
{{-- Chatbot JS --}}
<script>
    const faqAnswers = {
        "iptv": "IPTV UK World offers premium streaming of UK and international channels.",
        "subscribe": "To subscribe, visit our pricing page and select your plan.",
        "firestick": "Yes, you can install our IPTV app on Amazon Firestick.",
        "trial": "You can request a free trial from our homepage.",
        "pricing": "Our pricing plans are listed on the pricing page. Click 'View Plans' to learn more.",
        "renew": "You can renew by logging in and choosing your package again.",
        "legal": "IPTV legality depends on content sources. Our service is compliant with laws.",
        "connection code": "In SS IPTV, the connection code is used to link your device to your IPTV account.",
        "playlist": "To enter a playlist URL, go to settings > content > add playlist.",
        "smart tv": "Yes, we support most Smart TVs using our app or SS IPTV.",
        "channels": "We offer UK, USA, Sports, Movies, Kids, and International channels.",
        "support": "Our support team is available 24/7 through WhatsApp and Email.",
        "devices": "We support Smart TVs, Android Boxes, Firestick, Mobile, and PCs."
    };

    const chatMessages = document.getElementById('chatMessages');
    const userInput = document.getElementById('userInput');
    const sendBtn = document.getElementById('sendBtn');

    function addMessage(text, sender = 'bot') {
        const msgDiv = document.createElement('div');
        msgDiv.textContent = text;
        msgDiv.style.padding = '8px';
        msgDiv.style.margin = '6px 0';
        msgDiv.style.borderRadius = '10px';
        msgDiv.style.maxWidth = '80%';
        msgDiv.style.wordWrap = 'break-word';

        if (sender === 'user') {
            msgDiv.style.backgroundColor = '#0d6efd';
            msgDiv.style.color = 'white';
            msgDiv.style.marginLeft = 'auto';
        } else {
            msgDiv.style.backgroundColor = '#e2e3e5';
            msgDiv.style.color = '#000';
            msgDiv.style.marginRight = 'auto';
        }

        chatMessages.appendChild(msgDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function handleQuestion(inputText) {
        let question = inputText.trim().toLowerCase();
        addMessage(inputText, 'user');

        let answered = false;
        for (const key in faqAnswers) {
            if (question.includes(key)) {
                addMessage(faqAnswers[key], 'bot');
                answered = true;
                break;
            }
        }

        if (!answered) {
            addMessage("Sorry, I don't have an answer for that. Please contact support.", 'bot');
        }
    }

    sendBtn.addEventListener('click', () => {
        const text = userInput.value;
        if (text) {
            handleQuestion(text);
            userInput.value = '';
            userInput.focus();
        }
    });

    userInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') sendBtn.click();
    });

    document.querySelectorAll('.faq-question-button').forEach(button => {
        button.addEventListener('click', () => {
            handleQuestion(button.textContent);
        });
    });

    document.getElementById("chatbotToggle").addEventListener("click", function () {
        const box = document.getElementById("faqBotBox");
        box.style.display = box.style.display === "none" || box.style.display === "" ? "flex" : "none";
    });
</script>
@endsection
