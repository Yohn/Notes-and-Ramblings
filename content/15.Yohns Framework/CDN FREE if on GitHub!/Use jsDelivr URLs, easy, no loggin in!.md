---
link: https://medium.com/javarevisited/how-to-host-your-repository-js-css-on-open-source-cdn-jsdelivr-4de252d6fbad
byline: Vaibhav Singh
site: Javarevisited
date: 2020-10-06T02:28
updated:
type:
excerpt: |-
  Most CDN services are free till a limited capacity, thus developers tend to provide github raw urls as CDN for demo purposes in their projects. But jsDeliver open source 
   service provides CDN over Github code repository assets.
twitter: https://twitter.com/@javarevisited
tags:
  - cdn
  - free
  - free-cdn
  - not-my-writing
  - medium
  - jsdelivr
  - css-host
  - js-host
  - javascript
  - css
onion:
slurped: 2024-10-30T03:40
title: How to host your repository JS/CSS on Open Source CDN “jsDelivr”
modified: 2024-10-30T03:45:37-04:00
---

A couple of years back i was searching for an completely free & opensource cdn service but i couldn’t find any at that point of time & I ended up using Netlify (Another alternative was Hostry).

But then this idea struck “_what if there was a cdn service which could use Github as CDN_”. Most developers use [Github](https://medium.com/@javinpaul/top-10-free-courses-to-learn-git-and-github-best-of-lot-967aa314ea) as their code repository, keeping all their UI assets like fonts , js , css , images etc. Fast forward today, my quest ended on CDN delivery service called as [**jsDelivr**](https://www.jsdelivr.com/?docs=gh)**.**

jsDelivr open source cdn over github assets

## jsDelivr CDN over GitHub Assets

**jsDelivr** does exactly what many of us need, provides a opensource cdn over github assets. Let look into it in detail.

Here’s how it works.

1. jsDelivr CDN service’s base URL is `https://cdn.jsdelivr.net/gh/{username}/{repo}/`, where you replace `{username}` with the GitHub username and `{repo}` with the repository name for the project.
2. Append that URL with the path to the file you want to access in the project. For example, consider my sample project [Github-As-CDN](https://github.com/root0109/github-cdn) , the JavaScript file(**dummy-js-file.js**) is located in the `/dist` directory.
3.

```url
https://cdn.jsdelivr.net/gh/**root0109**/**github-cdn**/dist**/dummy-js-file.js
```

```javascript
<script src="https://cdn.jsdelivr.net/gh/**root0109**/**github-cdn**/dist**/dummy-js-file.js**"></script>
```

You can also take advantage of semantic versioning by adding `@{version-number}` to the repository name. You can target major, minor, and patch releases as desired.

## Load the latest version

```web
https://cdn.jsdelivr.net/gh/root0109/**github-cdn**/dist**/dummy-js-file.js**"></script>
```

## Load with Major Version only

```javascript
<script src="https://cdn.jsdelivr.net/gh/root0109/github-cdn**@2**/dist**/**dummy-js-file.js"></script>
```

## Load with Major.Minor Version

```javascript
<script src="https://cdn.jsdelivr.net/gh/root0109/github-cdn@**2.1**/dist/dummy-js-file.js"></script>
```

## Load Exact version

```url
https://cdn.jsdelivr.net/gh/root0109/github-cdn@**1.0.0**/dist/dummy-js-file.js
```

## Load minified version

Add “.min” to any JS/CSS file to get a minified version — if one doesn’t exist, it will be automatically generated for you.
