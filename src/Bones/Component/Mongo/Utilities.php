<?php

namespace Bones\Component\Mongo;

class Utilities
{
    /**
     * @param $timestamp
     * @param $fixtureId
     *
     * @return \MongoId
     */
    public static function generateMongoId($timestamp, $fixtureId)
    {
        $binaryTimestamp = pack('N', $timestamp);
        $hostname = substr(md5(gethostname()), 0, 3);
        $processId = pack('n', posix_getpid());
        $uniqueTrail = substr(pack('N', $fixtureId), 1, 3);

        $bin = sprintf('%s%s%s%s', $binaryTimestamp, $hostname, $processId, $uniqueTrail);

        $id = '';
        for ($i = 0; $i < 12; ++$i) {
            $id .= sprintf('%02X', ord($bin[$i]));
        }

        return new \MongoId($id);
    }
}
