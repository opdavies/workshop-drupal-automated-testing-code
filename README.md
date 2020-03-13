# Drupal Automated Testing Workshop: Example Code

## Updates

If we need to update any of the commits, the changes should be rebased into the existing commits so that they continue to be in a linear order as per the workshop document.

As we want GitHub Actions to run for each commit, we can’t just push the latest commit as that would only trigger a build on the final commit. To do this, we can loop over each of the commit SHAs and push each one separately:

```bash
for sha1 in $(git rev-list HEAD --reverse) ; do
  git push origin $sha1:master --force
done
```
