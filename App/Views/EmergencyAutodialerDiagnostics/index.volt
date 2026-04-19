<div class="ui dividing header">
    <i class="heartbeat icon"></i>
    {{ t._('emergency_autodialer_Diagnostics') }}
</div>

<div class="ui info message">
    {{ t._('emergency_autodialer_DiagnosticsPlaceholder') }}
</div>

<table class="ui compact celled table">
    <thead>
        <tr>
            <th>{{ t._('emergency_autodialer_Model') }}</th>
            <th>{{ t._('emergency_autodialer_Status') }}</th>
            <th>{{ t._('emergency_autodialer_Records') }}</th>
        </tr>
    </thead>
    <tbody>
        {% for modelStatus in modelStatuses %}
            <tr class="{% if modelStatus['ready'] %}positive{% else %}negative{% endif %}">
                <td>{{ modelStatus['name'] }}</td>
                <td>
                    {% if modelStatus['ready'] %}
                        {{ t._('emergency_autodialer_Ready') }}
                    {% else %}
                        {{ modelStatus['error'] }}
                    {% endif %}
                </td>
                <td>{{ modelStatus['count'] }}</td>
            </tr>
        {% endfor %}
    </tbody>
</table>
<img class="ui image" src="{{ url('assets/img/zenowl.png') }}">
