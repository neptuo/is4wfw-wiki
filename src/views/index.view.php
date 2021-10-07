<bs:resources />

<ce:urlResolver propertyName="url" name="page" columnName="url" />

<router:fromPath path="var:relativeUrl">
    <router:file path="" name="home">
        <h1>Wiki</h1>
        <ce:list name="page" orderBy-title="asc">
            <ce:register name="url" />
            <ui:forEach items="ce:list">
                <div>
                    <web:a pageId="route:page" text="ce:title" />
                </div>
            </ui:forEach>
        </ce:list>
    </router:file>
    <router:directory path="\ce:url">
        <var:declare name="pageUrl" value="ce:url" />
        <router:file name="edit" path="edit">
            <pages:edit />
        </router:file>
        <router:file path="" name="page">
            <ce:list name="page" filter-url="ce:url">
                <ui:empty items="ce:list">
                    Not found
                </ui:empty>
                <ui:first items="ce:list">
                    <h1>
                        <web:out text="ce:title" />
                    </h1>
                    <web:out text="ce:content" />
                </ui:first>
            </ce:list>
        </router:file>
    </router:directory>
    <router:file path="*">
        Not found
    </router:file>
</router:fromPath>

<bs:container>
    <router:render />
</bs:container>