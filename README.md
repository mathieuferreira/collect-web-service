Collect Web service
=========

A symfony Rest API to collect datas.

=========

Path : /collect

###### Return Examples:

```json
{"s":false,"e":["Parameter t is missing", "User wui not found"]}
```

```json
{"s": true}
```

| Parameter Name | Parameter format | Example | Description | Mandatory |
| --- | --- | --- | --- | --- |
| Success | s | s=true | Boolean describing if request was successfully executed or not | Yes |
| Errors | e | e=["Parameters are missing"] | Array of errors | Yes if not successfull |

