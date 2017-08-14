<?php
namespace Tyldar\Rancher\Models;

use Tyldar\Rancher\Models\AbstractModel;

class Container extends AbstractModel
{
    public $agentId;

    public $allocationState;

    public $blkioDeviceOptions;

    public $blkioWeight;

    public $build;

    public $capAdd;

    public $capDrop;

    public $cgroupParent;

    public $command;

    public $count;

    public $cpuCount;

    public $cpuPercent;

    public $cpuPeriod;

    public $cpuQuota;

    public $cpuSet;

    public $cpuSetMems;

    public $cpuShares;

    public $created;

    public $createdTS;

    public $createIndex;

    public $data;

    public $dataVolumeMounts;

    public $dataVolumes;

    public $dataVolumesFrom;
    
    public $description;

    public $devices;

    public $diskQuota;

    public $dns;

    public $dnsOpt;

    public $dnsSearch;

    public $domainName;

    public $entryPoint;

    public $environment;

    public $expose;

    public $extraHosts;

    public $firstRunning;

    public $groupAdd;

    public $healthCheck;

    public $healthCmd;

    public $healthInterval;

    public $healthRetries;

    public $healthState;

    public $healthTimeout;

    public $hostId;

    public $hostname;

    public $id;

    public $imageUuid;

    public $instanceLinks;

    public $instanceTriggeredStop;

    public $ioMaximumBandwidth;

    public $ioMaximumIOps;

    public $ip;

    public $ip6;

    public $ipcMode;

    public $isolation;

    public $kernelMemory;

    public $labels;

    public $logConfig;

    public $lxcConf;

    public $memory;

    public $memoryReservation;

    public $memorySwap;

    public $memorySwappiness;

    public $milliCpuReservation;

    public $mounts;

    public $name;

    public $netAlias;

    public $networkContainerId;

    public $networkIds;

    public $networkMode;

    public $oomKillDisable;

    public $oomScoreAdj;

    public $pidMode;

    public $pidsLimit;

    public $ports;

    public $privileged;

    public $publishAllPorts;

    public $readOnly;

    public $registryCredentialId;

    public $requestedHostId;

    public $restartPolicy;

    public $secrets;

    public $securityOpt;

    public $serviceId;

    public $serviceIds;

    public $shmSize;

    public $stackId;

    public $startCount;

    public $startOnCreate;

    public $state;

    public $stdinOpen;

    public $stopSignal;

    public $storageOpt;

    public $sysctls;

    public $system;

    public $tmpfs;

    public $tty;

    public $token;

    public $ulimits;

    public $user;

    public $userPorts;

    public $usernsMode;

    public $uts;

    public $version;

    public $volumeDriver;

    public $workingDir;

    public $_readOnlyFields = ["agentId", "allocationState", "createIndex", "data", "deploymentUnitUuid", "externalId", "firstRunning", "healthState", "hostId",
    "id", "mounts", "nativeContainer", "primaryIpAddress", "primaryNetworkId", "serviceId", "serviceIds", "startCount", "system", "token", "userPorts", "version"];
}