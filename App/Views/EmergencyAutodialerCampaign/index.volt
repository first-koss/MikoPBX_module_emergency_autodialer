<div class="ui secondary pointing menu">
    <a class="item {% if activeMenuItem == 'campaign' %}active{% endif %}" href="{{ url(moduleMenu['campaign']) }}">
        <i class="tasks icon"></i>{{ t._('emergency_autodialer_Campaigns') }}
    </a>
    <a class="item {% if activeMenuItem == 'settings' %}active{% endif %}" href="{{ url(moduleMenu['settings']) }}">
        <i class="gear icon"></i>{{ t._('emergency_autodialer_Settings') }}
    </a>
    <a class="item {% if activeMenuItem == 'diagnostics' %}active{% endif %}" href="{{ url(moduleMenu['diagnostics']) }}">
        <i class="heartbeat icon"></i>{{ t._('emergency_autodialer_Diagnostics') }}
    </a>
</div>

<div class="ui dividing header">
    <i class="tasks icon"></i>
    {{ t._('emergency_autodialer_Campaigns') }}
</div>

<div class="ui info message">
    {{ t._('emergency_autodialer_CampaignsPlaceholder') }}
</div>

{% if databaseError is not empty %}
    <div class="ui negative message">
        {{ databaseError }}
    </div>
{% else %}
    <div class="ui three statistics">
        <div class="statistic">
            <div class="value">{{ counters['campaigns'] }}</div>
            <div class="label">{{ t._('emergency_autodialer_Campaigns') }}</div>
        </div>
        <div class="statistic">
            <div class="value">{{ counters['campaignRecipients'] }}</div>
            <div class="label">{{ t._('emergency_autodialer_CampaignRecipients') }}</div>
        </div>
        <div class="statistic">
            <div class="value">{{ counters['callAttempts'] }}</div>
            <div class="label">{{ t._('emergency_autodialer_CallAttempts') }}</div>
        </div>
    </div>
{% endif %}
