set -e
mongosh <<EOF
db = db.getSiblingDB("admin");
db.createUser({
  user: '$MONGODB_USER',
  pwd:  '$MONGODB_PASSWORD',
  roles: [{
    role: 'readWrite',
    db: '$MONGODB_DB'
  }]
});
EOF