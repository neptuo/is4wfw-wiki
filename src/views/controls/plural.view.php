<if:greater name="plural" value="template:value" than="1" />
<web:out if:passed="plural">
    <web:out if:stringEmpty="template:plural">
        <utils:concat output="plural" value1="template:singular" value2="s" />
        <web:out text="utils:plural" />
    </web:out>
    <web:out text="template:plural" if:stringEmpty="template:plural" if:not="true" />
</web:out>
<web:out if:failed="plural">
    <web:out text="template:singular" />
</web:out>