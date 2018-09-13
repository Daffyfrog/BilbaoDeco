var path = require('path');

//List here the paths you do not want to be redirected to the angular application (scripts, stylesheets, templates, loopback REST API, ...)
var ignoredPaths = ['/config', '/css', '/js', '/img', '/model', '/nodes_modules', '/php', '/templates'];

app.all('/*', function(req, res, next) {
    //Redirecting to index only the requests that do not start with ignored paths
    if(!startsWith(req.url, ignoredPaths))
        res.sendFile('index.html', { root: path.resolve(__dirname, '..', 'client') });
    else
        next();
});

function startsWith(string, array) {
    for(i = 0; i < array.length; i++)
        if(string.startsWith(array[i]))
            return true;
    return false;
}