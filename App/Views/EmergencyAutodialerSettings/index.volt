<div class="ui dividing header">
    <i class="gear icon"></i>
    {{ t._('emergency_autodialer_Settings') }}
</div>

{% if databaseError is not empty %}
    <div class="ui negative message">
        {{ databaseError }}
    </div>
{% elseif scope is empty or form is empty %}
    <div class="ui warning message">
        {{ t._('emergency_autodialer_NoDefaultScope') }}
    </div>
{% else %}
    {{ form('emergency-autodialer/settings/save', 'role': 'form', 'class': 'ui large form', 'id': 'emergency-autodialer-settings-form') }}
        {{ form.render('id') }}

        <div class="ui segment">
            <div class="ui dividing header">
                {{ t._('emergency_autodialer_EntryPointSection') }}
            </div>
            <div class="ten wide field">
                <label>{{ t._('emergency_autodialer_ScopeName') }}</label>
                {{ form.render('name') }}
            </div>
            <div class="six wide field">
                <label>{{ t._('emergency_autodialer_ScopeCode') }}</label>
                <input type="text" value="{{ scope.code }}" readonly>
            </div>
            <div class="six wide field">
                <label>{{ t._('emergency_autodialer_LaunchExtension') }}</label>
                {{ form.render('launch_extension') }}
            </div>
            <div class="six wide field">
                <label>{{ t._('emergency_autodialer_LaunchPin') }}</label>
                {{ form.render('launch_pin') }}
            </div>
        </div>

        <div class="ui segment">
            <div class="ui dividing header">
                {{ t._('emergency_autodialer_SoundsSection') }}
            </div>
            <div class="ten wide field">
                <label>{{ t._('emergency_autodialer_WelcomeSound') }}</label>
                {{ form.render('welcome_sound_id') }}
            </div>
            <div class="ten wide field">
                <label>{{ t._('emergency_autodialer_InvalidSound') }}</label>
                {{ form.render('invalid_sound_id') }}
            </div>
            <div class="ui info message">
                {{ t._('emergency_autodialer_SoundsPlaceholder') }}
            </div>
        </div>

        <div class="ui segment">
            <div class="ui dividing header">
                {{ t._('emergency_autodialer_DefaultsSection') }}
            </div>
            <div class="four fields">
                <div class="field">
                    <label>{{ t._('emergency_autodialer_DefaultParallelLimit') }}</label>
                    {{ form.render('default_parallel_limit') }}
                </div>
                <div class="field">
                    <label>{{ t._('emergency_autodialer_DefaultMaxAttempts') }}</label>
                    {{ form.render('default_max_attempts') }}
                </div>
                <div class="field">
                    <label>{{ t._('emergency_autodialer_DefaultRetryDelay') }}</label>
                    {{ form.render('default_retry_delay_minutes') }}
                </div>
                <div class="field">
                    <label>{{ t._('emergency_autodialer_DefaultSuccessPlaySeconds') }}</label>
                    {{ form.render('default_success_play_seconds') }}
                </div>
            </div>
        </div>

        {{ partial("partials/submitbutton", ['indexurl': 'emergency-autodialer/settings/index']) }}
    {{ endform() }}
{% endif %}
