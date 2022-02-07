module.exports = {
  tagFormat: "${version}",
  branch: "master",
  plugins: [
    "@semantic-release/release-notes-generator",
    [
      "@semantic-release/changelog",
      {
        "changelogFile": "changelog.txt"
      }
    ],
    ["@semantic-release/npm", { npmPublish: false }],
    [
      "semantic-release-plugin-update-version-in-files",
      {
        "files": [
          "package.json",
          "style.css"
        ],
        "placeholder": "0.0.0-development"
      }
    ],
    ["@semantic-release/github", {
      "assets": [
        {"path": "build/jesus-film-www.zip", "label": "Bundled theme"}
      ]
    }]
  ]
};
