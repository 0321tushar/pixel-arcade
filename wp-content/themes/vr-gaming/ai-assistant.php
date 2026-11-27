<?php
/**
 * Pixel Arcade - AI Support Assistant Widget (PixelBot)
 * 24/7 Intelligent Gamer Support Assistant
 */
?>
<!-- PixelBot AI Assistant Launcher & Modal -->
<div id="pixelbot-wrapper">
  <!-- AI Chat Window -->
    <!-- 🤖 Floating AI Support Launcher Button -->
  <button id="pixelbot-launcher" class="pixelbot-launcher" onclick="togglePixelAIChat()" title="Chat with Pixel AI Support" aria-label="Open AI Support Chat">
    <div class="pixelbot-launcher-icon">🤖</div>
    <div class="pixelbot-launcher-content">
      <span class="pixelbot-launcher-title">Pixel AI</span>
      <span class="pixelbot-launcher-sub"><span class="pixelbot-online-dot"></span> Live Support</span>
    </div>
  </button>

  <div id="pixelbot-modal" class="pixelbot-modal" aria-hidden="true">
    <!-- Header -->
    <div class="pixelbot-header">
      <div class="pixelbot-header-left">
        <div class="pixelbot-avatar-wrap">
          <div class="pixelbot-avatar">🤖</div>
          <span class="pixelbot-status-ring"></span>
        </div>
        <div class="pixelbot-header-info">
          <div class="pixelbot-header-title">Pixel AI</div>
          <div class="pixelbot-header-sub"><span class="pixelbot-online-dot"></span> Live Support</div>
        </div>
      </div>
      <div class="pixelbot-header-actions">
        <button class="pixelbot-icon-btn" onclick="clearPixelAIChat()" title="Restart Chat">🔄</button>
        <button class="pixelbot-icon-btn pixelbot-close-btn" onclick="closePixelAIChat()" title="Close Assistant">✖</button>
      </div>
    </div>

    <!-- Chat Messages Scroll Area -->
    <div class="pixelbot-messages" id="pixelbot-messages">
      <!-- Initial Bot Welcome Message -->
      <div class="pixelbot-msg pixelbot-msg-bot">
        <div class="pixelbot-msg-avatar">🤖</div>
        <div class="pixelbot-bubble">
          <div class="pixelbot-bubble-content">
            Hey gamer! 👋 I am <strong>Pixel AI</strong>, your 24/7 Arcade Support Assistant. How can I help you today?
            <div class="pixelbot-quick-chips">
              <button type="button" class="pixelbot-chip" onclick="handleChipClick('tell me about soccer random')">⚽ Soccer Random</button>
              <button type="button" class="pixelbot-chip" onclick="handleChipClick('recommend top games')">🎮 Top Games</button>
              <button type="button" class="pixelbot-chip" onclick="handleChipClick('what discounts are in store?')">🛍️ Store Deals</button>
              <button type="button" class="pixelbot-chip" onclick="handleChipClick('how to contact human support?')">📞 Human Help</button>
            </div>
          </div>
          <span class="pixelbot-time">Just now</span>
        </div>
      </div>
    </div>

    <!-- Typing Indicator -->
    <div class="pixelbot-typing" id="pixelbot-typing" style="display: none;">
      <div class="pixelbot-msg-avatar">🤖</div>
      <div class="pixelbot-typing-bubble">
        <span class="pixelbot-typing-dot"></span>
        <span class="pixelbot-typing-dot"></span>
        <span class="pixelbot-typing-dot"></span>
      </div>
      <span class="pixelbot-typing-label">Pixel AI is thinking...</span>
    </div>

    <!-- Footer Input Bar -->
    <form class="pixelbot-footer" id="pixelbot-form" onsubmit="handleChatSubmit(event)">
      <input 
        type="text" 
        id="pixelbot-input" 
        class="pixelbot-input" 
        placeholder="Ask Pixel AI anything (e.g. recommend a game)..." 
        autocomplete="off"
        maxlength="300"
      />
            <button type="button" class="pixelbot-mic-btn" id="pixelbot-mic-btn" onclick="toggleVoiceInput()" title="Voice Input (Speak to Pixel AI)" aria-label="Voice Input">
        <svg class="pixelbot-mic-icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"/>
          <path d="M19 10v2a7 7 0 0 1-14 0v-2"/>
          <line x1="12" y1="19" x2="12" y2="23"/>
          <line x1="8" y1="23" x2="16" y2="23"/>
        </svg>
      </button>
      <button type="submit" class="pixelbot-send-btn" id="pixelbot-send-btn" title="Send message">
        <span>➤</span>
      </button>
    </form>
    <div class="pixelbot-brand-bar">
      <span>⚡ Powered by Pixel Arcade AI Support Engine</span>
    </div>
  </div>
</div>

<style>
/* === PIXELBOT AI ASSISTANT STYLING === */
/* Floating Launcher Button */
.pixelbot-launcher {
  position: fixed;
  bottom: 24px;
  right: 24px;
  z-index: 999990;
  display: flex;
  align-items: center;
  gap: 10px;
  background: linear-gradient(135deg, #0b101d 0%, #171b30 100%);
  border: 1.5px solid #00f0ff;
  border-radius: 35px;
  padding: 8px 18px 8px 10px;
  color: #ffffff;
  cursor: pointer;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.75), 0 0 20px rgba(0, 240, 255, 0.35);
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  outline: none;
}
.pixelbot-launcher:hover {
  transform: translateY(-4px) scale(1.04);
  box-shadow: 0 12px 35px rgba(0, 0, 0, 0.85), 0 0 28px rgba(0, 240, 255, 0.6);
  border-color: #38ef7d;
}
.pixelbot-launcher.active-hidden {
  opacity: 0;
  pointer-events: none;
  transform: scale(0.8);
}
.pixelbot-launcher-icon {
  font-size: 22px;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background: rgba(0, 240, 255, 0.15);
  border: 1px solid rgba(0, 240, 255, 0.4);
}
.pixelbot-launcher-content {
  display: flex;
  flex-direction: column;
  text-align: left;
}
.pixelbot-launcher-title {
  font-size: 13px;
  font-weight: 800;
  letter-spacing: 0.5px;
  color: #fff;
  line-height: 1.2;
}
.pixelbot-launcher-sub {
  font-size: 10px;
  color: #94a3b8;
  display: flex;
  align-items: center;
  gap: 4px;
}
.pixelbot-quick-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-top: 10px;
}
.pixelbot-chip {
  background: rgba(0, 240, 255, 0.12);
  border: 1px solid rgba(0, 240, 255, 0.35);
  color: #00f0ff;
  border-radius: 14px;
  font-size: 11px;
  font-weight: 700;
  padding: 4px 10px;
  cursor: pointer;
  transition: all 0.2s ease;
  font-family: inherit;
}
.pixelbot-chip:hover {
  background: #00f0ff;
  color: #000;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 240, 255, 0.4);
}

#pixelbot-wrapper {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  box-sizing: border-box;
}

#pixelbot-wrapper * {
  box-sizing: border-box;
}

/* Chat Modal Window */
.pixelbot-modal {
  position: fixed;
  bottom: 24px;
  right: 24px;
  width: 390px;
  max-width: calc(100vw - 32px);
  height: 580px;
  max-height: calc(100vh - 48px);
  background: linear-gradient(165deg, #0a0e17 0%, #101726 50%, #080b13 100%);
  border: 1px solid rgba(0, 240, 255, 0.45);
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.85), 0 0 30px rgba(0, 240, 255, 0.25);
  z-index: 999995;
  display: none;
  flex-direction: column;
  overflow: hidden;
  backdrop-filter: blur(16px);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
  transform: translateY(20px) scale(0.96);
  opacity: 0;
}

.pixelbot-modal.active {
  display: flex;
  transform: translateY(0) scale(1);
  opacity: 1;
}

/* Header */
.pixelbot-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 16px;
  background: linear-gradient(90deg, rgba(16, 24, 40, 0.95), rgba(11, 16, 28, 0.95));
  border-bottom: 1px solid rgba(0, 240, 255, 0.2);
}

.pixelbot-header-left {
  display: flex;
  align-items: center;
  gap: 12px;
}

.pixelbot-avatar-wrap {
  position: relative;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: linear-gradient(135deg, rgba(0, 240, 255, 0.2), rgba(168, 85, 247, 0.2));
  border: 1.5px solid #00f0ff;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 12px rgba(0, 240, 255, 0.4);
}

.pixelbot-avatar {
  font-size: 22px;
}

.pixelbot-header-title {
  font-size: 15px;
  font-weight: 800;
  color: #ffffff;
  display: flex;
  align-items: center;
  gap: 8px;
  letter-spacing: 0.5px;
}

.pixelbot-badge {
  font-size: 9px;
  font-weight: 800;
  color: #00f0ff;
  background: rgba(0, 240, 255, 0.12);
  border: 1px solid rgba(0, 240, 255, 0.35);
  padding: 2px 6px;
  border-radius: 4px;
  letter-spacing: 0.5px;
}

.pixelbot-header-sub {
  font-size: 11px;
  color: #94a3b8;
  display: flex;
  align-items: center;
  gap: 5px;
  margin-top: 2px;
}

.pixelbot-online-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #10b981;
  box-shadow: 0 0 6px #10b981;
}

.pixelbot-header-actions {
  display: flex;
  align-items: center;
  gap: 6px;
}

.pixelbot-icon-btn {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  color: #94a3b8;
  width: 30px;
  height: 30px;
  border-radius: 8px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  transition: all 0.2s ease;
}

.pixelbot-icon-btn:hover {
  background: rgba(0, 240, 255, 0.15);
  border-color: #00f0ff;
  color: #00f0ff;
  transform: scale(1.05);
}

/* Messages Area */
.pixelbot-messages {
  flex: 1;
  overflow-y: auto;
  padding: 16px;
  display: flex;
  flex-direction: column;
  gap: 14px;
  scroll-behavior: smooth;
}

.pixelbot-messages::-webkit-scrollbar {
  width: 5px;
}
.pixelbot-messages::-webkit-scrollbar-track {
  background: rgba(0, 0, 0, 0.2);
}
.pixelbot-messages::-webkit-scrollbar-thumb {
  background: rgba(0, 240, 255, 0.3);
  border-radius: 4px;
}

.pixelbot-msg {
  display: flex;
  gap: 10px;
  max-width: 88%;
  animation: pixelbotFadeIn 0.3s ease;
}

@keyframes pixelbotFadeIn {
  from { opacity: 0; transform: translateY(6px); }
  to { opacity: 1; transform: translateY(0); }
}

.pixelbot-msg-bot {
  align-self: flex-start;
}

.pixelbot-msg-user {
  align-self: flex-end;
  flex-direction: row-reverse;
}

.pixelbot-msg-avatar {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: rgba(0, 240, 255, 0.15);
  border: 1px solid rgba(0, 240, 255, 0.4);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  flex-shrink: 0;
}

.pixelbot-msg-user .pixelbot-msg-avatar {
  background: linear-gradient(135deg, #a855f7, #6366f1);
  border-color: #a855f7;
}

.pixelbot-bubble {
  display: flex;
  flex-direction: column;
}

.pixelbot-bubble-content {
  padding: 11px 14px;
  border-radius: 14px;
  font-size: 13px;
  line-height: 1.5;
  word-break: break-word;
}

.pixelbot-msg-bot .pixelbot-bubble-content {
  background: #141c2b;
  border: 1px solid rgba(0, 240, 255, 0.2);
  color: #e2e8f0;
  border-top-left-radius: 3px;
  box-shadow: 0 4px 14px rgba(0,0,0,0.3);
}

.pixelbot-msg-user .pixelbot-bubble-content {
  background: linear-gradient(135deg, #00d2d3 0%, #0984e3 100%);
  color: #ffffff;
  border-top-right-radius: 3px;
  box-shadow: 0 4px 14px rgba(0, 210, 211, 0.3);
}

.pixelbot-time {
  font-size: 10px;
  color: #64748b;
  margin-top: 3px;
  align-self: flex-start;
}

.pixelbot-msg-user .pixelbot-time {
  align-self: flex-end;
}

/* Links inside chat */
.pixelbot-bubble-content a {
  color: #00f0ff;
  text-decoration: underline;
  font-weight: 600;
  cursor: pointer;
}
.pixelbot-bubble-content a:hover {
  color: #38ef7d;
}

/* Bot Product/Game Mini Cards inside Chat */
.pixelbot-item-card {
  margin: 6px 0;
  padding: 8px 10px;
  background: rgba(9, 13, 22, 0.6);
  border: 1px solid rgba(0, 240, 255, 0.25);
  border-radius: 8px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.pixelbot-item-card .name {
  font-weight: 700;
  color: #f1f5f9;
}
.pixelbot-item-card .price {
  color: #00f0ff;
  font-weight: 800;
  font-size: 12px;
}

/* DeepSeek-R1 / Ollama Smart Thinking Process Accordion */
.pixelbot-thought-box {
  background: rgba(13, 20, 36, 0.85);
  border: 1px solid rgba(168, 85, 247, 0.4);
  border-left: 3px solid #a855f7;
  border-radius: 8px;
  margin: 6px 0 10px 0;
  padding: 8px 12px;
  font-size: 12px;
  line-height: 1.5;
  color: #cbd5e1;
  transition: all 0.2s ease;
}
.pixelbot-thought-box[open] {
  border-color: rgba(0, 240, 255, 0.5);
  border-left-color: #00f0ff;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4), inset 0 0 12px rgba(168, 85, 247, 0.1);
}
.pixelbot-thought-summary {
  cursor: pointer;
  font-weight: 700;
  color: #a855f7;
  display: flex;
  align-items: center;
  gap: 6px;
  user-select: none;
  outline: none;
}
.pixelbot-thought-box[open] .pixelbot-thought-summary {
  color: #00f0ff;
  margin-bottom: 8px;
  padding-bottom: 6px;
  border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
}
.pixelbot-thought-icon {
  font-size: 14px;
  animation: pulse-brain 2s infinite ease-in-out;
}
@keyframes pulse-brain {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.15); filter: drop-shadow(0 0 6px #00f0ff); }
}
.pixelbot-thought-badge {
  font-size: 10px;
  font-family: 'JetBrains Mono', monospace;
  background: rgba(168, 85, 247, 0.2);
  border: 1px solid rgba(168, 85, 247, 0.4);
  color: #d8b4fe;
  padding: 1px 6px;
  border-radius: 4px;
  margin-left: auto;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.pixelbot-thought-body {
  font-size: 11.5px;
  color: #94a3b8;
  font-style: italic;
  max-height: 220px;
  overflow-y: auto;
  padding-right: 4px;
}
.pixelbot-thought-body::-webkit-scrollbar {
  width: 4px;
}
.pixelbot-thought-body::-webkit-scrollbar-thumb {
  background: rgba(168, 85, 247, 0.4);
  border-radius: 4px;
}

/* Typing Indicator */
.pixelbot-typing {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 4px 16px 12px 16px;
}

.pixelbot-typing-bubble {
  display: flex;
  align-items: center;
  gap: 4px;
  background: #141c2b;
  border: 1px solid rgba(0, 240, 255, 0.2);
  padding: 8px 12px;
  border-radius: 14px;
  border-top-left-radius: 3px;
}

.pixelbot-typing-dot {
  width: 6px;
  height: 6px;
  background: #00f0ff;
  border-radius: 50%;
  animation: pixelbotTypingDot 1.4s infinite ease-in-out both;
}

.pixelbot-typing-dot:nth-child(1) { animation-delay: -0.32s; }
.pixelbot-typing-dot:nth-child(2) { animation-delay: -0.16s; }

@keyframes pixelbotTypingDot {
  0%, 80%, 100% { transform: scale(0); opacity: 0.4; }
  40% { transform: scale(1); opacity: 1; }
}

.pixelbot-typing-label {
  font-size: 11px;
  color: #64748b;
  font-style: italic;
}

/* Footer & Input */
.pixelbot-footer {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 14px;
  background: #0c111c;
  border-top: 1px solid rgba(0, 240, 255, 0.2);
}

.pixelbot-input {
  flex: 1;
  background: #141b2a;
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 12px;
  padding: 10px 14px;
  color: #ffffff;
  font-size: 13px;
  outline: none;
  transition: all 0.2s ease;
}

.pixelbot-input:focus {
  border-color: #00f0ff;
  box-shadow: 0 0 10px rgba(0, 240, 255, 0.3);
  background: #182133;
}

.pixelbot-input::placeholder {
  color: #64748b;
}


/* Mic Button Styling */
.pixelbot-mic-btn {
  background: rgba(255, 255, 255, 0.07);
  border: 1px solid rgba(0, 240, 255, 0.3);
  border-radius: 12px;
  width: 40px;
  height: 40px;
  color: #00f0ff;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
  flex-shrink: 0;
  outline: none;
}
.pixelbot-mic-btn:hover {
  background: rgba(0, 240, 255, 0.18);
  border-color: #00f0ff;
  color: #ffffff;
  transform: scale(1.06);
  box-shadow: 0 0 14px rgba(0, 240, 255, 0.5);
}
.pixelbot-mic-btn.listening {
  background: linear-gradient(135deg, #ff007f 0%, #e11d48 100%) !important;
  border-color: #ff007f !important;
  color: #ffffff !important;
  animation: micPulseAnimation 1.1s infinite alternate ease-in-out !important;
  box-shadow: 0 0 20px rgba(255, 0, 127, 0.85) !important;
}
@keyframes micPulseAnimation {
  0% { transform: scale(1); box-shadow: 0 0 8px rgba(255, 0, 127, 0.5); }
  100% { transform: scale(1.14); box-shadow: 0 0 24px rgba(255, 0, 127, 0.95); }
}

.pixelbot-send-btn {
  background: linear-gradient(135deg, #00d2d3, #0984e3);
  border: none;
  border-radius: 12px;
  width: 40px;
  height: 40px;
  color: #ffffff;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 16px;
  transition: all 0.2s ease;
  box-shadow: 0 4px 12px rgba(0, 210, 211, 0.4);
}

.pixelbot-send-btn:hover {
  transform: scale(1.06);
  box-shadow: 0 6px 18px rgba(0, 210, 211, 0.6);
}

.pixelbot-brand-bar {
  text-align: center;
  padding: 5px 0 7px 0;
  background: #090c14;
  font-size: 10px;
  color: #475569;
  letter-spacing: 0.3px;
  border-top: 1px solid rgba(255, 255, 255, 0.03);
}

@media (max-width: 480px) {
  .pixelbot-modal {
    width: 100vw;
    height: 100vh;
    max-width: 100vw;
    max-height: 100vh;
    bottom: 0;
    right: 0;
    border-radius: 0;
    border: none;
  }
}
</style>

<script>
/**
 * PixelBot AI Knowledge Engine & Chat Controller
 */
(function() {
  // Web Audio Synth for Subtle Gamer Sound Effects
  function playSound(type) {
    try {
      const AudioContext = window.AudioContext || window.webkitAudioContext;
      if (!AudioContext) return;
      const ctx = new AudioContext();
      const osc = ctx.createOscillator();
      const gain = ctx.createGain();
      osc.connect(gain);
      gain.connect(ctx.destination);

      if (type === 'open') {
        osc.frequency.setValueAtTime(440, ctx.currentTime);
        osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.08);
        gain.gain.setValueAtTime(0.08, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.12);
        osc.start();
        osc.stop(ctx.currentTime + 0.12);
      } else if (type === 'bot') {
        osc.frequency.setValueAtTime(620, ctx.currentTime);
        osc.frequency.exponentialRampToValueAtTime(740, ctx.currentTime + 0.07);
        gain.gain.setValueAtTime(0.06, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.1);
        osc.start();
        osc.stop(ctx.currentTime + 0.1);
      }
    } catch(e) {}
  }

  // Open Chat
  window.openPixelAIChat = function(e) {
    if (e && e.preventDefault) e.preventDefault();
    const modal = document.getElementById('pixelbot-modal');
    if (!modal) return;
    modal.classList.add('active');
    modal.setAttribute('aria-hidden', 'false');
    const launcher = document.getElementById('pixelbot-launcher');
    if (launcher) launcher.classList.add('active-hidden');
    playSound('open');
    setTimeout(function() {
      const input = document.getElementById('pixelbot-input');
      if (input) input.focus();
    }, 200);
  };

  // Close Chat
  window.closePixelAIChat = function() {
    const modal = document.getElementById('pixelbot-modal');
    if (!modal) return;
    modal.classList.remove('active');
    modal.setAttribute('aria-hidden', 'true');
    const launcher = document.getElementById('pixelbot-launcher');
    if (launcher) launcher.classList.remove('active-hidden');
  };

  // Toggle Chat
  window.togglePixelAIChat = function() {
    const modal = document.getElementById('pixelbot-modal');
    if (!modal) return;
    if (modal.classList.contains('active')) {
      closePixelAIChat();
    } else {
      openPixelAIChat();
    }
  };

  // Clear Chat History
  window.clearPixelAIChat = function() {
    const msgs = document.getElementById('pixelbot-messages');
    if (!msgs) return;
    msgs.innerHTML = `
      <div class="pixelbot-msg pixelbot-msg-bot">
        <div class="pixelbot-msg-avatar">🤖</div>
        <div class="pixelbot-bubble">
          <div class="pixelbot-bubble-content">
            Hey gamer! 👋 I am <strong>Pixel AI</strong>, your 24/7 Arcade Support Assistant. How can I help you today?
            <div class="pixelbot-quick-chips">
              <button type="button" class="pixelbot-chip" onclick="handleChipClick('tell me about soccer random')">⚽ Soccer Random</button>
              <button type="button" class="pixelbot-chip" onclick="handleChipClick('recommend top games')">🎮 Top Games</button>
              <button type="button" class="pixelbot-chip" onclick="handleChipClick('what discounts are in store?')">🛍️ Store Deals</button>
              <button type="button" class="pixelbot-chip" onclick="handleChipClick('how to contact human support?')">📞 Human Help</button>
            </div>
          </div>
          <span class="pixelbot-time">Just now</span>
        </div>
      </div>
    `;
  };

  // Handle Quick Chip Clicks
  window.handleChipClick = function(query) {
    const input = document.getElementById('pixelbot-input');
    if (input) {
      input.value = query;
      processUserMessage(query);
      input.value = '';
    }
  };

  // Handle Form Submission
  let isSubmittingMessage = false;

  window.handleChatSubmit = function(e) {
    if (e && e.preventDefault) e.preventDefault();
    if (isSubmittingMessage) return;

    const input = document.getElementById('pixelbot-input');
    if (!input) return;
    const text = input.value.trim();
    if (!text) return;

    isSubmittingMessage = true;
    input.value = '';
    processUserMessage(text);

    setTimeout(function() {
      isSubmittingMessage = false;
    }, 600);
  };

  // Append a message bubble to UI
  function appendMessage(sender, htmlContent) {
    const msgs = document.getElementById('pixelbot-messages');
    if (!msgs) return;

    const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    const isBot = (sender === 'bot');

    const msgEl = document.createElement('div');
    msgEl.className = 'pixelbot-msg ' + (isBot ? 'pixelbot-msg-bot' : 'pixelbot-msg-user');
    msgEl.innerHTML = `
      <div class="pixelbot-msg-avatar">${isBot ? '🤖' : '🎮'}</div>
      <div class="pixelbot-bubble">
        <div class="pixelbot-bubble-content">${htmlContent}</div>
        <span class="pixelbot-time">${timeStr}</span>
      </div>
    `;
    msgs.appendChild(msgEl);
    msgs.scrollTop = msgs.scrollHeight;

    if (isBot) playSound('bot');
  }

  
  // === 🎙️ WEB SPEECH API VOICE INPUT INTEGRATION ===
  let recognitionInstance = null;
  let isVoiceListening = false;

  window.toggleVoiceInput = function() {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const micBtn = document.getElementById('pixelbot-mic-btn');
    const input = document.getElementById('pixelbot-input');

    if (!SpeechRecognition) {
      appendMessage('bot', '⚠️ <em>Voice input is not supported in this browser. Please use Google Chrome, Microsoft Edge, or Safari, or type your message below!</em>');
      return;
    }

    if (isVoiceListening && recognitionInstance) {
      recognitionInstance.stop();
      return;
    }

    try {
      recognitionInstance = new SpeechRecognition();
      recognitionInstance.lang = 'en-IN'; // Optimized for English, Indian English & Hinglish accents
      recognitionInstance.interimResults = false;
      recognitionInstance.maxAlternatives = 1;

            let hasCapturedSpeech = false;

      recognitionInstance.onstart = function() {
        isVoiceListening = true;
        hasCapturedSpeech = false;
        if (micBtn) micBtn.classList.add('listening');
        if (input) {
          input.setAttribute('data-orig-placeholder', input.placeholder);
          input.placeholder = '🎙️ Listening... Speak now!';
        }
        playSound('open');
      };

      recognitionInstance.onresult = function(event) {
        if (hasCapturedSpeech) return;
        if (!event.results || !event.results[0] || !event.results[0][0]) return;
        const spokenText = event.results[0][0].transcript ? event.results[0][0].transcript.trim() : '';
        if (input && spokenText) {
          hasCapturedSpeech = true;
          input.value = spokenText;
          try { recognitionInstance.stop(); } catch(e) {}
          setTimeout(function() {
            window.handleChatSubmit(new Event('submit'));
          }, 250);
        }
      };

      recognitionInstance.onerror = function(event) {
        console.warn('Speech recognition status:', event.error);
        if (event.error === 'not-allowed') {
          appendMessage('bot', '🔒 <strong>Microphone permission needed:</strong> Please click the camera/mic icon in your browser URL bar and allow microphone access to talk to Pixel AI!');
        }
      };

      recognitionInstance.onend = function() {
        isVoiceListening = false;
        if (micBtn) micBtn.classList.remove('listening');
        if (input) {
          const orig = input.getAttribute('data-orig-placeholder') || 'Ask Pixel AI anything (e.g. recommend a game)...';
          input.placeholder = orig;
        }
      };

      recognitionInstance.start();
    } catch(err) {
      console.error('Speech recognition init error:', err);
      isVoiceListening = false;
      if (micBtn) micBtn.classList.remove('listening');
    }
  };

  // Conversation context history for multi-turn memory
  let conversationHistory = [];
  const hasCloudAPIKey = <?php 
    $s = class_exists('Pixel_Arcade_AI_Engine') ? Pixel_Arcade_AI_Engine::get_settings() : array();
    $isOllama = isset($s['provider']) && $s['provider'] === 'ollama';
    $isEnabled = isset($s['enabled']) && $s['enabled'] === '1';
    $hasKey = !empty($s['api_key']);
    echo ($isEnabled && ($hasKey || $isOllama)) ? 'true' : 'false'; 
  ?>;

  // Process User Input through Hybrid AI Engine (Cloud LLM + Zero-Downtime In-House Fallback)
  async function processUserMessage(rawText) {
    // Show user message bubble
    const escaped = rawText.replace(/</g, '&lt;').replace(/>/g, '&gt;');
    appendMessage('user', escaped);

    // Show typing indicator
    const typing = document.getElementById('pixelbot-typing');
    const msgs = document.getElementById('pixelbot-messages');
    if (typing) {
      typing.style.display = 'flex';
      if (msgs) msgs.scrollTop = msgs.scrollHeight;
    }

    const startTime = Date.now();
    let handledByCloud = false;

    // 1. ATTEMPT REAL-TIME CLOUD LLM IF CONFIGURED (ChatGPT / Gemini via WordPress REST API)
    if (hasCloudAPIKey) {
      try {
        const restEndpoint = '<?php echo esc_url(rest_url('pixelbot/v1/chat')); ?>' || '/wordpress/wp-json/pixelbot/v1/chat';
        const controller = new AbortController();
        const timeoutTimer = setTimeout(() => controller.abort(), 45000);

        const response = await fetch(restEndpoint, {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            message: rawText,
            history: conversationHistory
          }),
          signal: controller.signal
        });
        clearTimeout(timeoutTimer);

        if (response.ok) {
          const data = await response.json();
          if (data && data.success && data.reply) {
            const elapsed = Date.now() - startTime;
            const remainingDelay = Math.max(0, 450 - elapsed);
            setTimeout(() => {
              if (typing) typing.style.display = 'none';
              appendMessage('bot', data.reply);
              conversationHistory.push({ role: 'user', text: rawText });
              conversationHistory.push({ role: 'model', text: data.reply });
              if (conversationHistory.length > 10) conversationHistory = conversationHistory.slice(-10);
            }, remainingDelay);
            handledByCloud = true;
          }
        }
      } catch(e) {
        console.log('Pixel AI: Cloud timeout/error, using instant failover.');
      }
    }

    // 2. ZERO-DOWNTIME IN-HOUSE ENGINE (Instant, offline & guaranteed 100% uptime)
    if (!handledByCloud) {
      const elapsed = Date.now() - startTime;
      const delay = Math.max(0, 400 - elapsed);
      setTimeout(function() {
        if (typing) typing.style.display = 'none';
        const botResponse = generateAIResponse(rawText);
        appendMessage('bot', botResponse);
        conversationHistory.push({ role: 'user', text: rawText });
        conversationHistory.push({ role: 'model', text: botResponse.replace(/<[^>]*>?/gm, '') });
        if (conversationHistory.length > 10) conversationHistory = conversationHistory.slice(-10);
      }, delay);
    }
  }

  // Intelligent Knowledge Base & Response Generator
  function generateAIResponse(query) {
    if (!query) return "Main yahin hoon! Batao kya help chahiye?";
    const rawQ = query.trim();
    const q = rawQ.toLowerCase();

    // Clean punctuation for easier matching
    const cleanQ = q.replace(/[?!.,'"`~@#$%^&*()_+=\-\[\]{};:\\|<>]/g, ' ').replace(/\s+/g, ' ').trim();

    // 0. TOXIC / ABUSIVE / ANGER HANDLER
    const abusivePattern = /\b(fuck|fucking|fucker|shit|bitch|asshole|bastard|idiot|stupid|trash|noob|n00b|shut up|scam|garbage|loser|suck|sucks|chutiya|chutiye|gandu|bhenchod|behenchod|bc|mc|madarchod|bkl|lodu|lund|saale|sale|kamina|kameene|kutta|harami|bhosdike|bhosdi|tatti|pagal|chup kar|bakwas|teri ma|tere baap)\b/i;
    if (abusivePattern.test(cleanQ)) {
      const politeReplies = [
        `🛑 <strong>Easy there!</strong> Let's keep it respectful and friendly. Batao kya help chahiye?`,
        `😎 <strong>Chill gamer!</strong> Gussa hone ki zaroorat nahi hai. Koi problem ya issue aa raha hai toh batao, solve kar dete hain.`,
        `🎮 <strong>Good sportsmanship:</strong> No toxic language please! Batao kya issue hai, I am here to assist.`
      ];
      return politeReplies[Math.floor(Math.random() * politeReplies.length)];
    }

    // 0.1 FRUSTRATION / LOSS / TILT
    if (/\b(haar gaya|har gya|loss|lost|lost the match|lost the game|rage quit|tilted|tilt|irritating|dimag kharab)\b/i.test(cleanQ)) {
      return `🫂 <strong>Koi baat nahi gamer, hota hai!</strong> Losing streak sabki aati hai. Ek 5-minute ka break lo aur relax karo.`;
    }

    // 1. HELP REQUESTS & INTENTS ("can you help me", "help me", "need help", "help", "help chahiye")
    const helpPattern = /\b(can you help|help me|need help|help chahiye|help please|help kar sakte|help karoge|help karo|meri help|kuch help|can u help|could you help|assist me|support chahiye|kya help kar|madad chahiye|madad karo|help)\b/i;
    if (helpPattern.test(cleanQ)) {
      return `🤝 <strong>Haan bilkul! Batao kis cheez me help chahiye?</strong><br><br>Aap mujhse games info, Arcade Store ke orders, lag/FPS fixes, leaderboard ya digital keys ke baare me pooch sakte hain.`;
    }

    // 2. PERMISSION TO ASK / QUESTION PROMPT ("can i ask a question", "ek question hai", "doubt")
    if (/\b(can i ask|question hai|sawal hai|ek sawal|doubt hai|doubt|kuch poochna|pooch sakta|query hai|have a question|may i ask)\b/i.test(cleanQ)) {
      return `💡 <strong>Haan zaroor, poocho!</strong> Main yahin hoon aapke saare doubts aur sawal solve karne ke liye.`;
    }

    // 3. AVAILABILITY & PRESENCE ("are you there", "online ho", "suno", "koi hai")
    if (/\b(are you there|are u there|you there|u there|online ho|koi hai|anyone here|anyone there|sun rahe ho|suno|zinda ho)\b/i.test(cleanQ)) {
      return `👋 <strong>Haan, main yahin hoon! 24/7 active.</strong> Batao kya kaam tha?`;
    }

    // 4. CHIT-CHAT: "I AM GOOD / HOW ABOUT YOU / WHAT ABOUT YOU"
    const hasGoodFine = /\b(good|fine|great|awesome|mast|badhiya|badiya|theek|thik|all good|doing well|doing good)\b/i.test(cleanQ);
    const hasAboutYou = /\b(about you|abbout you|abt you|what about you|how about you|wbu|hbu|aur tu|aur tum|aur aap|and you|n u|what about u|how about u)\b/i.test(cleanQ);

    if (hasGoodFine && hasAboutYou) {
      return `😊 <strong>Glad to hear that!</strong> Main bhi ekdum badiya hoon, thanks for asking! Batao, kya help chahiye?`;
    }
    if (hasAboutYou) {
      return `😊 <strong>I am doing great!</strong> Thanks for asking. Batao, aaj kya help chahiye?`;
    }
    if (/\b(i am good|im good|i m good|iam good|i am fine|im fine|i m fine|doing good|doing great|sab badhiya|sab theek|ekdum mast|all good|feeling good)\b/i.test(cleanQ)) {
      return `🎉 <strong>Awesome!</strong> Sunke achha laga. Batao, how can I help you today?`;
    }

    // 5. GREETINGS & HOW ARE YOU
    if (/\b(kaisa hai|kaise ho|kya haal|how are you|how r u|how do you do|sab theek|kese ho)\b/i.test(cleanQ)) {
      return `👋 <strong>Main ekdum mast hoon!</strong> How are you doing today? Batao kya help chahiye?`;
    }

    // 6. WHAT ARE YOU DOING / WHAT'S UP
    if (/\b(kya kar rha|kya kar rahe|what are you doing|what r u doing|what's up|whats up|wassup|kya chal rha|kya chal raha)\b/i.test(cleanQ)) {
      return `😎 <strong>Bas yahin baitha hoon, gamers ki help karne ke liye!</strong> Batao, kya query hai?`;
    }

    // 7. HELLO / HI (Single clean greeting, NO bullet points)
    if (/\b(hi|hello|hey|yo|namaste|helo|halo|pranam|hola|greetings)\b/i.test(cleanQ)) {
      return `👋 <strong>Hello gamer!</strong> How can I help you today?`;
    }

    // 8. WHO ARE YOU / CREATOR / IDENTITY
    if (/\b(who are you|who r u|tu kaun|kya hai|kya kar sakta|what can you do|about you|your name|naam kya hai|kaun ho|who made you|who created you|developer|kisne banaya|owner|tushar)\b/i.test(cleanQ)) {
      return `🤖 <strong>I am Pixel AI</strong>, the virtual gaming assistant for <strong>Pixel Arcade</strong> (developed for Tushar Gautam). I help with game controls, store orders, key support, rankings, and lag fixes.`;
    }

    // 9. BORED / TIME PASS (Only when explicitly asked)
    if (/\b(bore ho rha|boring|bore|kya karu|time pass)\b/i.test(cleanQ)) {
      return `⚡ <strong>Bore ho rahe ho?</strong> Pixel Arcade par 8 high-FPS free games available hain! Top pe <strong>Play Now</strong> par click karke play kar sakte ho.`;
    }

    // 10. COMPLIMENTS & THANKS
    if (/\b(good bot|smart bot|nice bot|great bot|badiya bot|love you|you are smart|helpful|mast bot)\b/i.test(cleanQ)) {
      return `❤️ <strong>Thank you so much!</strong> Bas aap sabhi gamers ki help karne ki koshish hai.`;
    }
    if (/\b(thank|thanks|dhanyawad|shukriya|thx|ty)\b/i.test(cleanQ)) {
      return `❤️ <strong>You're welcome!</strong> Let me know whenever you need anything else.`;
    }

    // 11. ACKNOWLEDGMENTS ("ok", "okay", "cool", "hmm")
    if (/^(ok|okay|k|hmmm|hmm|haan|ha|theek hai|thik hai|sahi hai|cool|alright|got it|nice|fine|yep|yeah)[!.,\s]*$/i.test(cleanQ)) {
      return `👍 <strong>Awesome!</strong> Let me know whenever you need any help.`;
    }

    // 12. NEGATIVES / CLOSURE ("no", "nahi", "nothing", "bye")
    if (/^(no|nope|nahi|na|kuch nahi|nothing|all good|all set|bas aise hi)[!.,\s]*$/i.test(cleanQ)) {
      return `✨ <strong>Alright!</strong> Enjoy your gaming session. Main yahin hoon agar kuch chahiye ho.`;
    }
    if (/\b(bye|goodbye|cya|alvida|tata|see you|good night|gn)\b/i.test(cleanQ)) {
      return `👋 <strong>Goodbye gamer!</strong> Have a great time and enjoy gaming on Pixel Arcade!`;
    }

    // 13. LAG, FPS & PERFORMANCE FIXES
    if (/\b(lag|slow|fps|stuck|loading|black screen|freeze|crash|hanging|hang|atak|atak gyi|atak rha|fix|issue|problem|hardware acceleration)\b/i.test(cleanQ)) {
      return `⚡ <strong>Quick Lag & FPS Fix Guide:</strong><br><br>
        1. <strong>Hardware Acceleration:</strong> Browser <code>Settings -> System -> Turn ON Hardware Acceleration</code>.<br>
        2. <strong>Clear Cache:</strong> Press <code>Ctrl + Shift + R</code>.<br>
        3. <strong>Fullscreen Mode:</strong> Use <strong>Play Fullscreen</strong> for smooth 60 FPS.<br>
        4. <strong>Close Heavy Tabs:</strong> Close background video streams to free up RAM.`;
    }

    // 14. HUMAN SUPPORT & CONTACT
    if (/\b(human|call|phone|agent|number|hotline|email|helpdesk|office|studio|discord|contact)\b/i.test(cleanQ)) {
      return `📞 <strong>24/7 Support Hotline:</strong><br><br>
        • <strong>Phone:</strong> <a href="tel:+918004263774">+91 (800) 426-3774</a> (Toll-Free)<br>
        • <strong>Email:</strong> <a href="mailto:support@pixelarcade.io">support@pixelarcade.io</a>`;
    }

    // 15. REFUND, ORDER & PARCEL
    const hasRefund = /\b(fund|funds|refund|refunds|money|payment|payments|paid|pay|paisa|paise|deducted|kat gaye|kat gye)\b/i.test(cleanQ);
    const hasParcel = /\b(parcel|parcels|package|packages|courier|shipment|shipments|shipping|shipped|dispatch|dispatched|delivery|deliver|deliveries)\b/i.test(cleanQ);
    const hasOrder = /\b(order|orders|order status|current order|tracking|track order|where is my order|order tracking)\b/i.test(cleanQ);

    if ((hasRefund && hasParcel) || (hasRefund && hasOrder) || (hasParcel && hasOrder)) {
      return `📋 <strong>Order & Refund Details:</strong><br><br>
        • 📦 <strong>Physical Parcels:</strong> Dispatched in 24 hrs, delivered in 3–5 business days.<br>
        • 💳 <strong>Refunds:</strong> 100% money-back within 24–48 hrs; reflects in bank/UPI in 3–5 business days.<br>
        • 🔑 <strong>Game Keys:</strong> Emailed in 5–10 minutes.<br>
        For lookup, email <a href="mailto:support@pixelarcade.io">support@pixelarcade.io</a> with your Order ID.`;
    }
    if (hasRefund) {
      return `💳 <strong>Refund Status:</strong><br><br>
        All refunds are covered by a 100% money-back guarantee within 24–48 hours for unredeemed keys or canceled orders.<br>
        Amount reflects in bank/UPI/Card in <strong>3–5 business days</strong>.`;
    }
    if (hasParcel) {
      return `📦 <strong>Parcel & Delivery:</strong><br><br>
        Store orders are dispatched within 24 hours via express courier and delivered in <strong>3–5 business days</strong>. AWB tracking is emailed upon dispatch.`;
    }
    if (hasOrder) {
      return `📋 <strong>Order Status:</strong><br><br>
        • Digital Keys: Delivered to email within 5–10 minutes.<br>
        • Physical Gear: Delivered in 3–5 days.<br>
        Email your Order ID to <a href="mailto:support@pixelarcade.io">support@pixelarcade.io</a> for instant tracking.`;
    }

    // 16. STORE: CLOTHES & MERCH SPECIFIC
    if (/\b(cloth|clothes|tshirt|t-shirt|hoodie|jacket|jersey|cap|jogger|joggers|apparel|merch|wear)\b/i.test(cleanQ)) {
      return `👕 <strong>Arcade Store Apparel:</strong><br><br>
        • Cyberpunk Neon T-Shirt — $20.99<br>
        • Stealth Pro Hoodie — $44.99<br>
        • Windbreaker Tech Jacket — $59.99<br>
        • Esports Pro Team Jersey — $29.99<br>
        • Arcade Snapback Cap — $18.99<br>
        • Cargo Tactical Joggers — $36.99<br><br>
        👉 <a href="#arcade-store" onclick="closePixelAIChat()">View Clothes in Store</a>`;
    }

    // 17. STORE: TOOLS SPECIFIC
    if (/\b(tool|tools|gamepad|controller|soldering|driver|tweezers|thermal paste|mod kit|toolkit)\b/i.test(cleanQ)) {
      return `🔧 <strong>Arcade Modding & Repair Tools:</strong><br><br>
        • Wireless Mod Gamepad — $55.99<br>
        • Precision Tech Tool Kit — $24.99<br>
        • Soldering Iron Station — $49.99<br>
        • 64-in-1 Driver Set — $19.99<br>
        • Anti-Static Tweezers — $14.99<br>
        • Pro Thermal Paste Kit — $11.99<br><br>
        👉 <a href="#arcade-store" onclick="closePixelAIChat()">View Tools in Store</a>`;
    }

    // 18. STORE: COMPONENTS SPECIFIC
    if (/\b(component|components|keyboard|mouse|headset|ram|ddr5|ssd|nvme|cooler|liquid cooler|gpu|hardware)\b/i.test(cleanQ)) {
      return `⚡ <strong>PC Components:</strong><br><br>
        • Apex Pro Mechanical RGB Keyboard — $69.99<br>
        • Viper Optical Gaming Mouse (26K DPI) — $37.49<br>
        • Spatial 7.1 Surround Headset — $55.99<br>
        • Vengeance DDR5 32GB RAM Kit — $79.99<br>
        • HyperSpeed 1TB NVMe Gen4 SSD — $64.99<br>
        • Dual-Fan RGB Liquid Cooler — $49.99<br><br>
        👉 <a href="#arcade-store" onclick="closePixelAIChat()">View Components in Store</a>`;
    }

    // 19. STORE GENERAL & DEALS
    if (/\b(store|shop|buy|product|products|discount|deal|deals|coupon|sale|offer|sasta|rate|price|cost)\b/i.test(cleanQ)) {
      return `🛍️ <strong>Pixel Arcade Store:</strong><br><br>
        We have 3 categories: ⚡ <strong>Components</strong>, 👕 <strong>Clothes</strong>, and 🔧 <strong>Tools</strong>.<br>
        Current promotion: <strong>Flat 40% OFF</strong> on all items!<br><br>
        👉 <a href="#arcade-store" onclick="closePixelAIChat()">Browse Arcade Store</a>`;
    }

    // 20. SPECIFIC GAMES (ONLY when specifically asked)
    if (/\b(soccer random|football|ragdoll soccer)\b/i.test(cleanQ)) {
      return `⚽ <strong>Soccer Random:</strong> 2-player physics soccer game.<br><br>
        • <strong>Controls:</strong> Press <strong>W</strong> (Player 1) or <strong>Up Arrow</strong> (Player 2) to jump and kick.<br><br>
        👉 <a href="http://localhost/wordpress/soccer-random-2-player-ragdoll/" onclick="closePixelAIChat()">Play Soccer Random</a>`;
    }
    if (/\b(basket random)\b/i.test(cleanQ)) {
      return `🏀 <strong>Basket Random:</strong> 2-player ragdoll basketball.<br><br>
        • <strong>Controls:</strong> Up Arrow (Player 1) or W Key (Player 2).<br><br>
        👉 <a href="http://localhost/wordpress/basket-random-2-player-ragdoll/" onclick="closePixelAIChat()">Play Basket Random</a>`;
    }
    if (/\b(iron snout)\b/i.test(cleanQ)) {
      return `🥋 <strong>Iron Snout:</strong> Kung Fu pig fighting off wolves.<br><br>
        • <strong>Controls:</strong> Arrow keys to punch, kick, and dodge.<br><br>
        👉 <a href="http://localhost/wordpress/iron-snout-kung-fu-fighting/" onclick="closePixelAIChat()">Play Iron Snout</a>`;
    }
    if (/\b(drive mad|truck|driving)\b/i.test(cleanQ)) {
      return `🚚 <strong>Drive Mad:</strong> 4x4 physics stunt driving.<br><br>
        • <strong>Controls:</strong> W / D or Arrow Keys.<br><br>
        👉 <a href="http://localhost/wordpress/free-city-drive-3d-car-simulator/" onclick="closePixelAIChat()">Play Drive Mad</a>`;
    }
    if (/\b(subway surfers|runner)\b/i.test(cleanQ)) {
      return `🏃 <strong>Subway Surfers:</strong> Endless railway runner.<br><br>
        • <strong>Controls:</strong> Arrow keys (Up = jump, Down = roll, Left/Right = turn). Space = Hoverboard.<br><br>
        👉 <a href="http://localhost/wordpress/subway-surfers-world-tour/" onclick="closePixelAIChat()">Play Subway Surfers</a>`;
    }
    if (/\b(vex|vex 5|parkour)\b/i.test(cleanQ)) {
      return `🧗 <strong>Vex 5 Platformer:</strong> Stickman parkour platformer.<br><br>
        • <strong>Controls:</strong> W/A/S/D or Arrow Keys.<br><br>
        👉 <a href="http://localhost/wordpress/vex-5-stickman-parkour/" onclick="closePixelAIChat()">Play Vex 5</a>`;
    }
    if (/\b(boxing random)\b/i.test(cleanQ)) {
      return `🥊 <strong>Boxing Random:</strong> 2-player ragdoll boxing.<br><br>
        • <strong>Controls:</strong> W (Player 1) or Up Arrow (Player 2).<br><br>
        👉 <a href="http://localhost/wordpress/boxing-random-2-player-ragdoll/" onclick="closePixelAIChat()">Play Boxing Random</a>`;
    }
    if (/\b(tomb runner)\b/i.test(cleanQ)) {
      return `🏺 <strong>Tomb Runner:</strong> Fast-paced temple escape runner.<br><br>
        • <strong>Controls:</strong> Arrow keys to jump, slide, and steer.<br><br>
        👉 <a href="http://localhost/wordpress/tomb-runner-infinite-temple-escape/" onclick="closePixelAIChat()">Play Tomb Runner</a>`;
    }

    // 21. GAME RECOMMENDATIONS (ONLY WHEN EXPLICITLY ASKED)
    if (/\b(recommend game|recommend games|suggest game|suggest games|best game|best games|game batao|game suggest|khelne ke liye game|konsa game khele|top games)\b/i.test(cleanQ)) {
      return `🎮 <strong>Top Free Games:</strong><br><br>
        1. ⚽ <strong>Soccer Random</strong> (2-Player Physics Soccer)<br>
        2. 🏀 <strong>Basket Random</strong> (2-Player Basketball)<br>
        3. 🥋 <strong>Iron Snout</strong> (Kung-Fu Action)<br>
        4. 🚚 <strong>Drive Mad</strong> (Stunt Driving)<br>
        5. 🏃 <strong>Subway Surfers</strong> (Endless Runner)<br>
        6. 🧗 <strong>Vex 5</strong> (Parkour Platformer)`;
    }

    // 22. LEADERBOARD & RANKINGS
    if (/\b(leaderboard|rank|ranking|rankings|elo|points|score|top player|viper|tournament|winner)\b/i.test(cleanQ)) {
      return `🏆 <strong>Pixel Arcade Leaderboard:</strong><br><br>
        • <strong>#1:</strong> Viper_X (2,840 ELO)<br>
        • <strong>#2:</strong> ShadowNinja (2,795 ELO)<br>
        • <strong>#3:</strong> CyberKnight (2,750 ELO)<br><br>
        👉 <a href="#leaderboard" onclick="closePixelAIChat()">View Full Leaderboard</a>`;
    }

    // 23. GAME KEY & REDEEM HELP
    if (/\b(key|keys|code|codes|redeem|activation|digital key|serial|licence|license)\b/i.test(cleanQ)) {
      return `🔑 <strong>Digital Game Key Support:</strong><br><br>
        • Keys are emailed within 5–10 minutes of purchase.<br>
        • Redeem on Steam via <code>Games -> Activate a Product on Steam</code>.<br>
        • If not received, email <a href="mailto:support@pixelarcade.io">support@pixelarcade.io</a> with your Order ID.`;
    }

    // 24. SMART CATCH-ALL (Welcoming & helpful, never says "Main theek se samjha nahi")
    return `🤖 <strong>Main yahin hoon aapki help ke liye!</strong><br><br>Aap mujhse games (controls, recommendations), Arcade Store ke orders, digital keys, leaderboard ya lag fix ke baare me pooch sakte hain. Batao kya query hai?`;
  }

  // Global event delegation for "START INSTANT CHAT" and related buttons
  document.addEventListener('click', function(e) {
    const target = e.target;
    if (!target) return;

    // Check button click
    const btn = target.closest('a, button');
    if (!btn) return;

    const text = (btn.innerText || btn.textContent || '').trim();
    const href = btn.getAttribute('href') || '';
    const cls = btn.className || '';

    if (
      text.includes('START INSTANT CHAT') ||
      cls.includes('btn-support-chat') ||
      cls.includes('btn-start-chat') ||
      href.includes('#instant-chat') ||
      href.includes('support-chat')
    ) {
      e.preventDefault();
      openPixelAIChat(e);
    }
  });

})();
</script>
