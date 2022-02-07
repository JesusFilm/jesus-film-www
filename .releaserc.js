module.exports = {
  tagFormat: "${version}",
  branch: "master",
  plugins: [
    "@semantic-release/commit-analyzer",
    "@semantic-release/release-notes-generator",
    ["@semantic-release/npm", { 
      npmPublish: false 
    }],
    ["@semantic-release/exec", {
      "publishCmd": "./bin/build-zip.sh ${nextRelease.version}"
    }],
    ["@semantic-release/github", {
      "assets": [
        {"path": "build/jesus-film-www.zip", "label": "Bundled theme"}
      ]
    }]
  ]
};
