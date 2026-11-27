<?php
/**
 * Pixel Arcade - Production-Grade AI Engine (OpenAI ChatGPT & Google Gemini)
 * Client-Ready Admin Settings & Auto-Failover API Controller
 */

if (!defined('ABSPATH')) {
    exit;
}

class Pixel_Arcade_AI_Engine {

    const OPTION_KEY = 'pixel_arcade_ai_settings';

    public function __construct() {
        // Admin menu & settings
        add_action('admin_menu', array($this, 'register_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));

        // AJAX Handlers (Frontend Chat & Admin Test)
        add_action('wp_ajax_pixelbot_chat', array($this, 'handle_chat_request'));
        add_action('wp_ajax_nopriv_pixelbot_chat', array($this, 'handle_chat_request'));
        add_action('wp_ajax_pixel_ai_test_connection', array($this, 'handle_test_connection'));

        // REST API route
        add_action('rest_api_init', array($this, 'register_rest_routes'));
    }

    /**
     * Default Configuration
     */
    public static function get_default_settings() {
        return array(
            'enabled' => '1',
            'provider' => 'ollama', // 'ollama', 'gemini', or 'openai'
            'ollama_endpoint' => 'http://127.0.0.1:11434',
            'ollama_model' => 'deepseek-r1:8b',
            'api_key' => '',
            'gemini_model' => 'gemini-1.5-flash',
            'openai_model' => 'gpt-4o-mini',
            'temperature' => '0.7',
            'hybrid_fallback' => '1',
            'system_prompt' => "You are Pixel AI, the official live intelligent gaming assistant of Pixel Arcade (pixelarcade.io).
Tone: Energetic, witty, helpful, polite gamer vibe. You speak fluent English, Hindi, and natural Hinglish.
Knowledge Base:
- 8 Offline Top Games: Soccer Random (2-player physics ragdoll soccer), Basket Random (2-player basketball), Boxing Random, Iron Snout (Kung-fu pig fighter), Drive Mad (4x4 physics stunt), Subway Surfers (infinite runner), Vex 5 (stickman parkour), Tomb Runner.
- Store & Gear: Flat 40% OFF across PC Components (Keyboards, Mice, DDR5 RAM, NVMe SSDs), Apparel (Neon T-shirts, Tech Hoodies, Jerseys), Mod Tools.
- Orders & Delivery: Physical parcels dispatched within 24 hours, delivered in 3-5 days. Digital keys emailed in 5-10 minutes. 100% money-back guarantee within 24-48 hours.
- Performance: Fix lag via browser Hardware Acceleration, Ctrl+Shift+R, and fullscreen mode.
Guidelines:
- Keep answers concise, helpful, and natural (1-3 sentences for chit-chat, bullet points only when specifically asked for guides or lists).
- Never invent unauthorized discounts or fake policies. Stay true to Pixel Arcade."
        );
    }

    /**
     * Get Current Settings
     */
    public static function get_settings() {
        $saved = get_option(self::OPTION_KEY, array());
        return wp_parse_args($saved, self::get_default_settings());
    }

    /**
     * Register Admin Menu
     */
    public function register_admin_menu() {
        add_menu_page(
            __('Pixel AI Assistant', 'vr-gaming'),
            __('🤖 Pixel AI', 'vr-gaming'),
            'manage_options',
            'pixel-ai-settings',
            array($this, 'render_admin_page'),
            'dashicons-format-chat',
            59
        );
    }

    /**
     * Register Settings Group
     */
    public function register_settings() {
        register_setting('pixel_ai_settings_group', self::OPTION_KEY);
    }

    /**
     * Register REST API Routes
     */
    public function register_rest_routes() {
        register_rest_route('pixelbot/v1', '/chat', array(
            'methods' => 'POST',
            'callback' => array($this, 'rest_chat_handler'),
            'permission_callback' => '__return_true',
        ));
    }

    /**
     * REST Handler
     */
    public function rest_chat_handler($request) {
        $params = $request->get_json_params();
        $message = sanitize_text_field($params['message'] ?? '');
        $history = $params['history'] ?? array();
        return $this->process_ai_chat($message, $history);
    }

    /**
     * AJAX Chat Handler
     */
    public function handle_chat_request() {
        $message = sanitize_text_field($_POST['message'] ?? '');
        $history_raw = $_POST['history'] ?? '[]';
        $history = json_decode(stripslashes($history_raw), true);
        if (!is_array($history)) $history = array();

        $result = $this->process_ai_chat($message, $history);
        wp_send_json($result);
    }

    /**
     * Core AI Process Engine
     */
    public function process_ai_chat($message, $history = array()) {
        if (empty($message)) {
            return array('success' => false, 'error' => 'Empty message');
        }

        $settings = self::get_settings();
        $enabled = ($settings['enabled'] === '1');
        $apiKey = trim($settings['api_key']);
        $provider = $settings['provider'];

        // If AI is disabled or API Key is missing for non-ollama providers, trigger fallback seamlessly
        if (!$enabled || ($provider !== 'ollama' && empty($apiKey))) {
            return array(
                'success' => false,
                'fallback' => true,
                'reason' => empty($apiKey) ? 'no_api_key' : 'disabled'
            );
        }

        if ($provider === 'ollama') {
            return $this->call_ollama($settings['ollama_endpoint'] ?? 'http://127.0.0.1:11434', $settings['ollama_model'] ?? 'deepseek-r1:8b', $settings['system_prompt'], $message, $history);
        } elseif ($provider === 'openai') {
            return $this->call_openai($apiKey, $settings['openai_model'], $settings['system_prompt'], $message, $history);
        } else {
            return $this->call_gemini($apiKey, $settings['gemini_model'], $settings['system_prompt'], $message, $history);
        }
    }

    /**
     * Call Google Gemini API
     */
    private function call_gemini($apiKey, $model, $systemPrompt, $message, $history) {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . urlencode($apiKey);

        // Build contents history
        $contents = array();
        
        // Take up to last 6 history items for context
        $trimmed_history = array_slice($history, -6);
        foreach ($trimmed_history as $item) {
            $role = ($item['role'] === 'user') ? 'user' : 'model';
            $text = sanitize_text_field($item['text'] ?? '');
            if (!empty($text)) {
                $contents[] = array(
                    'role' => $role,
                    'parts' => array(array('text' => $text))
                );
            }
        }

        // Add current user message
        $contents[] = array(
            'role' => 'user',
            'parts' => array(array('text' => $message))
        );

        $payload = array(
            'systemInstruction' => array(
                'parts' => array(array('text' => $systemPrompt))
            ),
            'contents' => $contents,
            'generationConfig' => array(
                'temperature' => 0.7,
                'maxOutputTokens' => 500
            )
        );

        $response = wp_remote_post($url, array(
            'headers' => array('Content-Type' => 'application/json'),
            'body' => json_encode($payload),
            'timeout' => 8,
            'sslverify' => false
        ));

        if (is_wp_error($response)) {
            return array(
                'success' => false,
                'fallback' => true,
                'error' => $response->get_error_message()
            );
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if ($code !== 200 || !isset($body['candidates'][0]['content']['parts'][0]['text'])) {
            $err = $body['error']['message'] ?? ('HTTP ' . $code);
            return array(
                'success' => false,
                'fallback' => true,
                'error' => $err
            );
        }

        $reply = trim($body['candidates'][0]['content']['parts'][0]['text']);
        // Format markdown to clean HTML
        $replyHtml = $this->markdown_to_html($reply);

        return array(
            'success' => true,
            'reply' => $replyHtml,
            'provider' => 'Google Gemini (' . $model . ')'
        );
    }

    /**
     * Call OpenAI ChatGPT API
     */
    private function call_openai($apiKey, $model, $systemPrompt, $message, $history) {
        $url = 'https://api.openai.com/v1/chat/completions';

        $messages = array();
        $messages[] = array('role' => 'system', 'content' => $systemPrompt);

        $trimmed_history = array_slice($history, -6);
        foreach ($trimmed_history as $item) {
            $role = ($item['role'] === 'user') ? 'user' : 'assistant';
            $text = sanitize_text_field($item['text'] ?? '');
            if (!empty($text)) {
                $messages[] = array('role' => $role, 'content' => $text);
            }
        }

        $messages[] = array('role' => 'user', 'content' => $message);

        $payload = array(
            'model' => $model,
            'messages' => $messages,
            'temperature' => 0.7,
            'max_tokens' => 500
        );

        $response = wp_remote_post($url, array(
            'headers' => array(
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $apiKey
            ),
            'body' => json_encode($payload),
            'timeout' => 8,
            'sslverify' => false
        ));

        if (is_wp_error($response)) {
            return array(
                'success' => false,
                'fallback' => true,
                'error' => $response->get_error_message()
            );
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if ($code !== 200 || !isset($body['choices'][0]['message']['content'])) {
            $err = $body['error']['message'] ?? ('HTTP ' . $code);
            return array(
                'success' => false,
                'fallback' => true,
                'error' => $err
            );
        }

        $reply = trim($body['choices'][0]['message']['content']);
        $replyHtml = $this->markdown_to_html($reply);

        return array(
            'success' => true,
            'reply' => $replyHtml,
            'provider' => 'OpenAI ChatGPT (' . $model . ')'
        );
    }

    /**
     * Call Local Ollama (DeepSeek-R1 / LLaMA / Mistral)
     */
    private function call_ollama($endpoint, $model, $systemPrompt, $message, $history) {
        $endpoint = rtrim($endpoint ?: 'http://127.0.0.1:11434', '/');
        $url = $endpoint . '/api/chat';

        $messages = array();
        $messages[] = array('role' => 'system', 'content' => $systemPrompt);

        $trimmed_history = array_slice($history, -6);
        foreach ($trimmed_history as $item) {
            $role = ($item['role'] === 'user') ? 'user' : 'assistant';
            $text = sanitize_text_field($item['text'] ?? '');
            if (!empty($text)) {
                $messages[] = array('role' => $role, 'content' => $text);
            }
        }

        $messages[] = array('role' => 'user', 'content' => $message);

        $payload = array(
            'model' => $model ?: 'deepseek-r1:8b',
            'messages' => $messages,
            'stream' => false,
            'options' => array(
                'temperature' => 0.7
            )
        );

        $response = wp_remote_post($url, array(
            'headers' => array('Content-Type' => 'application/json'),
            'body' => json_encode($payload),
            'timeout' => 45,
            'sslverify' => false
        ));

        if (is_wp_error($response)) {
            return array(
                'success' => false,
                'fallback' => true,
                'error' => 'Ollama Connection Failed: ' . $response->get_error_message() . ' (Ensure Ollama is running on ' . esc_html($endpoint) . ')'
            );
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = json_decode(wp_remote_retrieve_body($response), true);

        if ($code !== 200 || !isset($body['message']['content'])) {
            $err = $body['error'] ?? ('HTTP ' . $code);
            return array(
                'success' => false,
                'fallback' => true,
                'error' => 'Ollama Error: ' . $err
            );
        }

        $rawReply = trim($body['message']['content']);
        $thoughtContent = !empty($body['message']['thinking']) ? trim($body['message']['thinking']) : '';

        // Also check if thinking tokens are inside content: <think> ... </think>
        if (empty($thoughtContent) && preg_match('/<think>(.*?)<\/think>/s', $rawReply, $matches)) {
            $thoughtContent = trim($matches[1]);
            $rawReply = trim(str_replace($matches[0], '', $rawReply));
        }

        $thinkingHtml = '';
        if (!empty($thoughtContent)) {
            $formattedThought = nl2br(esc_html($thoughtContent));
            $thinkingHtml = '<details class="pixelbot-thought-box" open><summary class="pixelbot-thought-summary"><span class="pixelbot-thought-icon">🧠</span> Smart Thinking Process <span class="pixelbot-thought-badge">DeepSeek-R1</span></summary><div class="pixelbot-thought-body">' . $formattedThought . '</div></details>';
        }

        $replyHtml = $thinkingHtml . $this->markdown_to_html($rawReply);

        return array(
            'success' => true,
            'reply' => $replyHtml,
            'provider' => 'Local Ollama (' . $model . ')'
        );
    }

    /**
     * Helper: Convert Markdown to Safe HTML for Chat Bubble
     */
    private function markdown_to_html($text) {
        // Bold
        $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
        // Code
        $text = preg_replace('/`(.*?)`/', '<code>$1</code>', $text);
        // Newlines
        $text = nl2br($text);
        return $text;
    }

    /**
     * AJAX Test Connection
     */
    public function handle_test_connection() {
        check_ajax_referer('pixel_ai_admin_nonce', 'nonce');
        if (!current_user_can('manage_options')) {
            wp_send_json_error(array('message' => 'Unauthorized'));
        }

        $provider = sanitize_text_field($_POST['provider'] ?? 'ollama');
        $apiKey = trim(sanitize_text_field($_POST['api_key'] ?? ''));
        $model = sanitize_text_field($_POST['model'] ?? '');
        $ollamaEndpoint = sanitize_text_field($_POST['ollama_endpoint'] ?? 'http://127.0.0.1:11434');

        if ($provider !== 'ollama' && empty($apiKey)) {
            wp_send_json_error(array('message' => 'Please enter an API Key first.'));
        }

        $testPrompt = "You are a test agent. Reply with exactly: CONNECTION_OK";

        if ($provider === 'ollama') {
            $res = $this->call_ollama($ollamaEndpoint, $model ?: 'deepseek-r1:8b', $testPrompt, 'Ping test', array());
        } elseif ($provider === 'openai') {
            $res = $this->call_openai($apiKey, $model ?: 'gpt-4o-mini', $testPrompt, 'Ping test', array());
        } else {
            $res = $this->call_gemini($apiKey, $model ?: 'gemini-1.5-flash', $testPrompt, 'Ping test', array());
        }

        if (!empty($res['success'])) {
            wp_send_json_success(array(
                'message' => 'Connected successfully! Verified with ' . esc_html($res['provider'])
            ));
        } else {
            wp_send_json_error(array(
                'message' => 'API Error: ' . esc_html($res['error'] ?? 'Connection failed')
            ));
        }
    }

    /**
     * Render Admin Settings Page
     */
    public function render_admin_page() {
        if (!current_user_can('manage_options')) return;

        $settings = self::get_settings();
        $nonce = wp_create_nonce('pixel_ai_admin_nonce');
        ?>
        <div class="wrap pixel-ai-admin-wrap" style="max-width: 960px; margin-top: 25px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
            
            <!-- Header Banner -->
            <div style="background: linear-gradient(135deg, #090d16 0%, #111a2e 100%); border: 1px solid rgba(0, 240, 255, 0.4); border-radius: 14px; padding: 24px 30px; color: #fff; margin-bottom: 25px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
                    <div>
                        <h1 style="color: #00f0ff; margin: 0 0 8px 0; font-size: 24px; font-weight: 800; display: flex; align-items: center; gap: 10px;">
                            <span>🤖</span> Pixel Arcade — AI Engine Control Panel
                        </h1>
                        <p style="margin: 0; color: #94a3b8; font-size: 13.5px;">
                            Configure commercial ChatGPT (OpenAI) or Google Gemini intelligence for your live arcade chat assistant.
                        </p>
                    </div>
                    <div style="background: rgba(0, 240, 255, 0.1); border: 1px solid rgba(0, 240, 255, 0.3); padding: 8px 16px; border-radius: 30px; font-size: 12px; font-weight: 700; color: #00f0ff; display: flex; align-items: center; gap: 8px;">
                        <span style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; box-shadow: 0 0 8px #10b981;"></span>
                        Enterprise Grade • Auto-Failover Active
                    </div>
                </div>
            </div>

            <?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) : ?>
                <div class="notice notice-success is-dismissible" style="border-left-color: #00f0ff;">
                    <p><strong>Pixel AI Settings saved successfully!</strong> Your live chat engine has been updated.</p>
                </div>
            <?php endif; ?>

            <form method="post" action="options.php" id="pixel-ai-form">
                <?php settings_fields('pixel_ai_settings_group'); ?>

                <!-- Settings Card -->
                <div style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 25px 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 25px;">
                    
                    <h2 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-top: 0; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 8px;">
                        <span>⚙️</span> Provider & Model Configuration
                    </h2>

                    <table class="form-table" role="presentation" style="margin-top: 0;">
                        
                        <!-- Enable Engine -->
                        <tr>
                            <th scope="row" style="font-weight: 600; color: #334155;">AI Engine Status</th>
                            <td>
                                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 600;">
                                    <input type="checkbox" name="<?php echo self::OPTION_KEY; ?>[enabled]" value="1" <?php checked($settings['enabled'], '1'); ?> />
                                    <span>Enable Real-Time Cloud LLM Engine</span>
                                </label>
                                <p class="description" style="color: #64748b;">When enabled, queries will be processed by ChatGPT / Gemini. If disabled, runs on offline in-house rules.</p>
                            </td>
                        </tr>

                        <!-- AI Provider -->
                        <tr>
                            <th scope="row" style="font-weight: 600; color: #334155;">AI Provider</th>
                            <td>
                                <select name="<?php echo self::OPTION_KEY; ?>[provider]" id="pixel_ai_provider" style="min-width: 280px; padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                                    <option value="ollama" <?php selected($settings['provider'], 'ollama'); ?>>🖥️ Local Ollama (100% Free &amp; Private, DeepSeek-R1 / LLaMA)</option>
                                    <option value="gemini" <?php selected($settings['provider'], 'gemini'); ?>>Google Gemini (Fast &amp; Free Tier Available)</option>
                                    <option value="openai" <?php selected($settings['provider'], 'openai'); ?>>OpenAI ChatGPT (GPT-4o / GPT-4o-mini)</option>
                                </select>
                                <p class="description" style="color: #64748b;">Select which AI model provider powers your assistant.</p>
                            </td>
                        </tr>

                        <!-- Ollama Local Endpoint & Model -->
                        <tr id="row-ollama-endpoint" style="<?php echo ($settings['provider'] === 'ollama') ? '' : 'display:none;'; ?>">
                            <th scope="row" style="font-weight: 600; color: #334155;">Ollama Endpoint</th>
                            <td>
                                <input type="text" name="<?php echo self::OPTION_KEY; ?>[ollama_endpoint]" id="pixel_ollama_endpoint" value="<?php echo esc_attr($settings['ollama_endpoint'] ?? 'http://127.0.0.1:11434'); ?>" class="regular-text" style="padding: 7px 12px; border-radius: 6px; font-family: monospace;" />
                                <p class="description" style="color: #64748b;">Default is <code>http://127.0.0.1:11434</code> (Local machine server).</p>
                            </td>
                        </tr>

                        <tr id="row-ollama-model" style="<?php echo ($settings['provider'] === 'ollama') ? '' : 'display:none;'; ?>">
                            <th scope="row" style="font-weight: 600; color: #334155;">Ollama Smart Model</th>
                            <td>
                                <select name="<?php echo self::OPTION_KEY; ?>[ollama_model]" id="pixel_ollama_model" style="min-width: 280px; padding: 6px 12px; border-radius: 6px; font-weight: 600;">
                                    <option value="deepseek-r1:8b" <?php selected($settings['ollama_model'] ?? 'deepseek-r1:8b', 'deepseek-r1:8b'); ?>>deepseek-r1:8b (Recommended: Smart Thinking &amp; Reasoning)</option>
                                    <option value="deepseek-r1:1.5b" <?php selected($settings['ollama_model'] ?? '', 'deepseek-r1:1.5b'); ?>>deepseek-r1:1.5b (Ultra-Fast Thinking for Lower Specs)</option>
                                    <option value="llama3.2" <?php selected($settings['ollama_model'] ?? '', 'llama3.2'); ?>>llama3.2 (Meta LLaMA 3.2 High Accuracy)</option>
                                    <option value="mistral" <?php selected($settings['ollama_model'] ?? '', 'mistral'); ?>>mistral (7B Gamer Friendly)</option>
                                </select>
                                <p class="description" style="color: #64748b;">DeepSeek-R1 outputs full internal reasoning in &lt;think&gt; tokens, displayed in an interactive expandable box!</p>
                            </td>
                        </tr>

                        <!-- API Key -->
                        <tr id="row-api-key" style="<?php echo ($settings['provider'] === 'ollama') ? 'display:none;' : ''; ?>">
                            <th scope="row" style="font-weight: 600; color: #334155;">API Key</th>
                            <td>
                                <div style="display: flex; gap: 10px; max-width: 550px; align-items: center;">
                                    <input type="password" name="<?php echo self::OPTION_KEY; ?>[api_key]" id="pixel_ai_api_key" value="<?php echo esc_attr($settings['api_key']); ?>" class="regular-text" style="flex: 1; padding: 7px 12px; border-radius: 6px; font-family: monospace;" placeholder="Enter your Gemini or OpenAI API Key..." />
                                    <button type="button" class="button" id="toggle-key-visibility" title="Show/Hide Key">👁️</button>
                                </div>
                                <p class="description" style="color: #64748b; margin-top: 6px;">
                                    Key is securely stored in your database and never exposed to website visitors.
                                </p>
                            </td>
                        </tr>

                        <!-- Gemini Model -->
                        <tr id="row-gemini-model" style="<?php echo ($settings['provider'] === 'gemini') ? '' : 'display:none;'; ?>">
                            <th scope="row" style="font-weight: 600; color: #334155;">Gemini Model</th>
                            <td>
                                <select name="<?php echo self::OPTION_KEY; ?>[gemini_model]" id="pixel_gemini_model" style="min-width: 280px; padding: 6px 12px; border-radius: 6px;">
                                    <option value="gemini-1.5-flash" <?php selected($settings['gemini_model'], 'gemini-1.5-flash'); ?>>gemini-1.5-flash (Recommended: Ultra-fast & High Accuracy)</option>
                                    <option value="gemini-1.5-pro" <?php selected($settings['gemini_model'], 'gemini-1.5-pro'); ?>>gemini-1.5-pro (Deep reasoning)</option>
                                </select>
                            </td>
                        </tr>

                        <!-- OpenAI Model -->
                        <tr id="row-openai-model" style="<?php echo ($settings['provider'] === 'openai') ? '' : 'display:none;'; ?>">
                            <th scope="row" style="font-weight: 600; color: #334155;">OpenAI Model</th>
                            <td>
                                <select name="<?php echo self::OPTION_KEY; ?>[openai_model]" id="pixel_openai_model" style="min-width: 280px; padding: 6px 12px; border-radius: 6px;">
                                    <option value="gpt-4o-mini" <?php selected($settings['openai_model'], 'gpt-4o-mini'); ?>>gpt-4o-mini (Recommended: Fast, Smart & Economical)</option>
                                    <option value="gpt-4o" <?php selected($settings['openai_model'], 'gpt-4o'); ?>>gpt-4o (Flagship Multimodal)</option>
                                </select>
                            </td>
                        </tr>

                        <!-- Hybrid Safety Fallback -->
                        <tr>
                            <th scope="row" style="font-weight: 600; color: #334155;">Zero-Downtime Fallback</th>
                            <td>
                                <label style="display: inline-flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 600;">
                                    <input type="checkbox" name="<?php echo self::OPTION_KEY; ?>[hybrid_fallback]" value="1" <?php checked($settings['hybrid_fallback'], '1'); ?> />
                                    <span>Automatic Local Engine Fallback (Guaranteed 100% Uptime)</span>
                                </label>
                                <p class="description" style="color: #64748b;">
                                    If the API key runs out of balance, rate limits, or network times out, the chat will silently and automatically answer via the built-in local knowledge engine without showing any errors to users.
                                </p>
                            </td>
                        </tr>

                    </table>

                    <!-- Test Connection Button & Status -->
                    <div style="margin-top: 15px; padding-top: 20px; border-top: 1px solid #f1f5f9; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                        <button type="button" class="button button-secondary" id="btn-test-ai-connection" style="height: 36px; padding: 0 16px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
                            <span>⚡</span> Test API Connection Live
                        </button>
                        <div id="test-connection-status" style="font-size: 13px; font-weight: 600;"></div>
                    </div>

                </div>

                <!-- System Prompt / Persona Card -->
                <div style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; padding: 25px 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-bottom: 25px;">
                    
                    <h2 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-top: 0; margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                        <span>🧠</span> AI System Prompt & Brand Personality
                    </h2>
                    <p style="color: #64748b; font-size: 13px; margin-top: 0; margin-bottom: 16px;">
                        These instructions guide how the AI behaves, what products it recommends, and its tone. The prompt is already pre-configured for Pixel Arcade.
                    </p>

                    <textarea name="<?php echo self::OPTION_KEY; ?>[system_prompt]" rows="10" style="width: 100%; font-family: monospace; font-size: 12.5px; line-height: 1.5; padding: 12px; border-radius: 8px; border-color: #cbd5e1;"><?php echo esc_textarea($settings['system_prompt']); ?></textarea>
                </div>

                <!-- Submit Button -->
                <div style="display: flex; gap: 12px; align-items: center;">
                    <?php submit_button('💾 Save AI Configuration', 'primary', 'submit', false, array('style' => 'height: 42px; padding: 0 24px; font-size: 14px; font-weight: 700; background: #0284c7; border-color: #0284c7;')); ?>
                </div>

            </form>
        </div>

        <script>
        (function() {
            const providerSelect = document.getElementById('pixel_ai_provider');
            const rowOllamaEndpoint = document.getElementById('row-ollama-endpoint');
            const rowOllamaModel = document.getElementById('row-ollama-model');
            const rowApiKey = document.getElementById('row-api-key');
            const rowGemini = document.getElementById('row-gemini-model');
            const rowOpenai = document.getElementById('row-openai-model');
            const toggleKeyBtn = document.getElementById('toggle-key-visibility');
            const keyInput = document.getElementById('pixel_ai_api_key');
            const testBtn = document.getElementById('btn-test-ai-connection');
            const statusDiv = document.getElementById('test-connection-status');

            // Switch Model row based on provider
            providerSelect.addEventListener('change', function() {
                if (this.value === 'ollama') {
                    rowOllamaEndpoint.style.display = '';
                    rowOllamaModel.style.display = '';
                    rowApiKey.style.display = 'none';
                    rowGemini.style.display = 'none';
                    rowOpenai.style.display = 'none';
                } else if (this.value === 'openai') {
                    rowOllamaEndpoint.style.display = 'none';
                    rowOllamaModel.style.display = 'none';
                    rowApiKey.style.display = '';
                    rowGemini.style.display = 'none';
                    rowOpenai.style.display = '';
                } else {
                    rowOllamaEndpoint.style.display = 'none';
                    rowOllamaModel.style.display = 'none';
                    rowApiKey.style.display = '';
                    rowGemini.style.display = '';
                    rowOpenai.style.display = 'none';
                }
            });

            // Toggle show/hide API key
            if (toggleKeyBtn && keyInput) {
                toggleKeyBtn.addEventListener('click', function() {
                    if (keyInput.type === 'password') {
                        keyInput.type = 'text';
                        toggleKeyBtn.innerText = '🔒';
                    } else {
                        keyInput.type = 'password';
                        toggleKeyBtn.innerText = '👁️';
                    }
                });
            }

            // Live Test Connection AJAX
            testBtn.addEventListener('click', function() {
                const provider = providerSelect.value;
                const apiKey = keyInput ? keyInput.value.trim() : '';
                let model = '';
                let ollamaEndpoint = '';

                if (provider === 'ollama') {
                    model = document.getElementById('pixel_ollama_model').value;
                    ollamaEndpoint = document.getElementById('pixel_ollama_endpoint').value;
                } else if (provider === 'openai') {
                    model = document.getElementById('pixel_openai_model').value;
                } else {
                    model = document.getElementById('pixel_gemini_model').value;
                }

                if (provider !== 'ollama' && !apiKey) {
                    statusDiv.innerHTML = '<span style="color:#ef4444;">⚠️ Please enter an API key to test.</span>';
                    return;
                }

                statusDiv.innerHTML = '<span style="color:#0284c7;">🔄 Testing connection to ' + provider.toUpperCase() + ' (' + model + ')...</span>';
                testBtn.disabled = true;

                const formData = new FormData();
                formData.append('action', 'pixel_ai_test_connection');
                formData.append('nonce', '<?php echo esc_js($nonce); ?>');
                formData.append('provider', provider);
                formData.append('api_key', apiKey);
                formData.append('model', model);
                formData.append('ollama_endpoint', ollamaEndpoint);

                fetch(ajaxurl, {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(data => {
                    testBtn.disabled = false;
                    if (data.success) {
                        statusDiv.innerHTML = '<span style="color:#10b981;">✅ ' + data.data.message + '</span>';
                    } else {
                        statusDiv.innerHTML = '<span style="color:#ef4444;">❌ ' + data.data.message + '</span>';
                    }
                })
                .catch(err => {
                    testBtn.disabled = false;
                    statusDiv.innerHTML = '<span style="color:#ef4444;">❌ Network error: ' + err.message + '</span>';
                });
            });
        })();
        </script>
        <?php
    }
}

// Initialize AI Engine
new Pixel_Arcade_AI_Engine();
