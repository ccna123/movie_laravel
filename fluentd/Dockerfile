FROM fluent/fluentd:v1.12-debian-1

USER root

# Install plugins
RUN gem install fluent-plugin-concat
RUN gem install fluent-plugin-rewrite-tag-filter
RUN gem install fluent-plugin-json

# Create the log directory
RUN mkdir -p /fluentd/logs

# We'll run as root for now
# USER fluent
