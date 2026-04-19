<div class="ui dividing header">
    <i class="gear icon"></i>
    {{ t._('emergency_autodialer_Settings') }}
</div>

<div class="ui info message">
    {{ t._('emergency_autodialer_SettingsPlaceholder') }}
</div>

{% if databaseError is not empty %}
    <div class="ui negative message">
        {{ databaseError }}
    </div>
{% elseif scope is empty %}
    <div class="ui warning message">
        {{ t._('emergency_autodialer_NoDefaultScope') }}
    </div>
{% else %}
    <table class="ui compact definition table">
        <tbody>
            <tr>
                <td>{{ t._('emergency_autodialer_ScopeName') }}</td>
                <td>{{ scope.name }}</td>
            </tr>
            <tr>
                <td>{{ t._('emergency_autodialer_ScopeCode') }}</td>
                <td>{{ scope.code }}</td>
            </tr>
            <tr>
                <td>{{ t._('emergency_autodialer_LaunchExtension') }}</td>
                <td>{{ scope.launch_extension }}</td>
            </tr>
            <tr>
                <td>{{ t._('emergency_autodialer_DefaultParallelLimit') }}</td>
                <td>{{ scope.default_parallel_limit }}</td>
            </tr>
            <tr>
                <td>{{ t._('emergency_autodialer_DefaultMaxAttempts') }}</td>
                <td>{{ scope.default_max_attempts }}</td>
            </tr>
            <tr>
                <td>{{ t._('emergency_autodialer_DefaultRetryDelay') }}</td>
                <td>{{ scope.default_retry_delay_minutes }}</td>
            </tr>
            <tr>
                <td>{{ t._('emergency_autodialer_DefaultSuccessPlaySeconds') }}</td>
                <td>{{ scope.default_success_play_seconds }}</td>
            </tr>
        </tbody>
    </table>
{% endif %}
