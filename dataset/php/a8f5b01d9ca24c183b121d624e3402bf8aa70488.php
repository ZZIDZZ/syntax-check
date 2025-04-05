public static function getApiText(int $apikey): string
    {
        $apis = [
            self::PRODUCE_REQUEST           => 'ProduceRequest',
            self::FETCH_REQUEST             => 'FetchRequest',
            self::OFFSET_REQUEST            => 'OffsetRequest',
            self::METADATA_REQUEST          => 'MetadataRequest',
            self::OFFSET_COMMIT_REQUEST     => 'OffsetCommitRequest',
            self::OFFSET_FETCH_REQUEST      => 'OffsetFetchRequest',
            self::GROUP_COORDINATOR_REQUEST => 'GroupCoordinatorRequest',
            self::JOIN_GROUP_REQUEST        => 'JoinGroupRequest',
            self::HEART_BEAT_REQUEST        => 'HeartbeatRequest',
            self::LEAVE_GROUP_REQUEST       => 'LeaveGroupRequest',
            self::SYNC_GROUP_REQUEST        => 'SyncGroupRequest',
            self::DESCRIBE_GROUPS_REQUEST   => 'DescribeGroupsRequest',
            self::LIST_GROUPS_REQUEST       => 'ListGroupsRequest',
            self::SASL_HAND_SHAKE_REQUEST   => 'SaslHandShakeRequest',
            self::API_VERSIONS_REQUEST      => 'ApiVersionsRequest',
        ];

        return $apis[$apikey] ?? 'Unknown message';
    }