<bs:row>
    <bs:column small="12" medium="6" large="4">
        <edit:form submit="login">
            <web:condition when="edit:save">
                <login:login group="wiki" username="edit:username" password="edit:password" cookieName="wiki">
                    <web:condition when="var:lastPage" isInverted="true">
                        <var:declare name="lastPage" value="route:home" />
                    </web:condition>
                    <web:condition when="var:lastPage" is="route:login">
                        <var:declare name="lastPage" value="route:home" />
                    </web:condition>
                    <web:redirectTo pageId="var:lastPage" />
                    <web:redirectTo pageId="route:home" />
                </login:login>
            </web:condition>
            <web:condition when="post:login">
                <p class="text-danger font-weight-bold">
                    Wrong combination of username and password.
                </p>
            </web:condition>
            
            <bs:formGroup label="Username:" field="username">
                <ui:textbox name="username" class="bs:fieldValidatorCssClass" autofocus="autofocus" />
            </bs:formGroup>
            <bs:formGroup label="Password:" field="password">
                <ui:passwordbox name="password" type="password" class="bs:fieldValidatorCssClass" />
            </bs:formGroup>
            
            <bs:button name="login" value="login" color="secondary" class="mt-2 px-3">
                Login
            </bs:button>
        </edit:form>
    </bs:column>
</bs:row>